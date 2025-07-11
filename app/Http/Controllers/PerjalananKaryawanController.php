<?php

namespace App\Http\Controllers;

use App\Models\AlamatRumah;
use App\Models\BahanBakar;
use App\Models\KaryawanPerusahaan;
use App\Models\PerjalananKaryawanPerusahaan;
use App\Models\Transportasi;
use Illuminate\Http\Request;

class PerjalananKaryawanController extends Controller
{
    public function index(Request $request)
    {
        if ($redirect = $this->checkifLoginForCompany()) return $redirect;

        $query = PerjalananKaryawanPerusahaan::query();

        // Filter nama_karyawan
        if ($request->filled('nama_karyawan')) {
            $query->whereHas('karyawanPerusahaan', function ($q) use ($request) {
                $q->where('nama_karyawan', 'like', '%' . $request->nama_karyawan . '%');
            });
        }

        // Filter nama_bahan_bakar
        if ($request->filled('nama_bahan_bakar')) {
            $query->whereHas('bahanBakar', function ($q) use ($request) {
                $q->where('nama_bahan_bakar', 'like', '%' . $request->nama_bahan_bakar . '%');
            });
        }

        // Filter nama_transportasi
        if ($request->filled('nama_transportasi')) {
            $query->whereHas('transportasi', function ($q) use ($request) {
                $q->where('nama_transportasi', 'like', '%' . $request->nama_transportasi . '%');
            });
        }

        // Filter tanggal_perjalanan
        if ($request->filled('tanggal_perjalanan')) {
            $query->whereDate('tanggal_perjalanan', $request->tanggal_perjalanan);
        }

        $query->orderBy('tanggal_perjalanan', 'desc');

        $perjalanans = $query->paginate(5);

        $karyawans = KaryawanPerusahaan::all();
        $bahanbakars = BahanBakar::all();
        $transportasis = Transportasi::all();

        return view('dashboardPerusahaan.layouts.perjalananKaryawanPerusahaan.view', [
            'dataKaryawan' => $karyawans,
            'dataBahanBakar' => $bahanbakars,
            'dataTransportasi' => $transportasis,
            'data' => $perjalanans,
            'dataType' => 'perjalanan',
            'request' => $request
        ]);
    }

    public function add()
    {
        if ($redirect = $this->checkifLoginForCompany()) return $redirect;
        $transportasis = Transportasi::all();
        $bahanbakars = BahanBakar::all();
        $alamats = AlamatRumah::all();
        $karyawans = KaryawanPerusahaan::all();

        return view('dashboardPerusahaan.layouts.perjalananKaryawanPerusahaan.add', ['dataTransportasi' => $transportasis, 'dataBahanBakar' => $bahanbakars, 'dataAlamat' => $alamats, 'dataKaryawan' => $karyawans]);
    }

    public function store(Request $request)
    {
        if ($redirect = $this->checkifLoginForCompany()) return $redirect;
        $validatedData = $request->validate([
            'employee_name' => 'required',
            'transportation' => 'required',
            'fuel' => 'required',
            'address' => 'required',
            'trip_date' => 'required',
            'trip_duration' => 'required',
        ]);

        // Cek duplikat berdasarkan nama karyawan dan tanggal perjalanan
        $existing = PerjalananKaryawanPerusahaan::where('id_karyawan', $request->employee_name)
            ->where('tanggal_perjalanan', $request->trip_date)
            ->first();

        if ($existing) {
            return redirect('dashboard/perusahaan/perjalanan/add')
                ->with('failed', 'Data sudah ada (data duplikat)');
        }

        $bahanBakar = BahanBakar::find($request->fuel);

        PerjalananKaryawanPerusahaan::create([
            'id_karyawan' => $request->employee_name,
            'id_transportasi' => $request->transportation,
            'id_bahan_bakar' => $request->fuel,
            'id_perusahaan' => 1,
            'id_alamat' => $request->address,
            'tanggal_perjalanan' => $request->trip_date,
            'durasi_perjalanan' => $request->trip_duration,
            'total_emisi_karbon' => $bahanBakar->emisi_karbon_permenit * $request->trip_duration,
        ]);

        return redirect('dashboard/perusahaan/perjalanan/add')->with('success', 'Data Successfully Added');
    }


    public function delete($id)
    {
        if ($redirect = $this->checkifLoginForCompany()) return $redirect;
        PerjalananKaryawanPerusahaan::destroy($id);
        return redirect('dashboard/perusahaan/perjalanan')->with('success', 'Data Successfully Deleted');
    }

    public function destroy($id)
    {
        if ($redirect = $this->checkifLoginForCompany()) return $redirect;
        PerjalananKaryawanPerusahaan::findOrFail($id)->delete();

        return redirect()->back()->with('deleted', 'Data berhasil dihapus');
    }


    public function edit($id)
    {
        if ($redirect = $this->checkifLoginForCompany()) return $redirect;
        $transportasis = Transportasi::all();
        $bahanbakars = BahanBakar::all();
        $alamats = AlamatRumah::all();
        $karyawans = KaryawanPerusahaan::all();

        $oldData = PerjalananKaryawanPerusahaan::find($id);

        // return ($oldData);

        return view('dashboardPerusahaan.layouts.perjalananKaryawanPerusahaan.edit', ['dataTransportasi' => $transportasis, 'dataBahanBakar' => $bahanbakars, 'dataAlamat' => $alamats, 'dataKaryawan' => $karyawans, 'oldData' => $oldData, 'id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        if ($redirect = $this->checkifLoginForCompany()) return $redirect;
        $validatedData = $request->validate([
            'employee_name' => 'required',
            'transportation' => 'required',
            'fuel' => 'required',
            'address' => 'required',
            'trip_date' => 'required',
            'trip_duration' => 'required',
        ]);

        $bahanBakar = BahanBakar::find($request->fuel);

        PerjalananKaryawanPerusahaan::where('id', $id)->update([
            'id_karyawan' => $request->employee_name,
            'id_transportasi' => $request->transportation,
            'id_bahan_bakar' => $request->fuel,
            'id_perusahaan' => 1,
            'id_alamat' => $request->address,
            'tanggal_perjalanan' => $request->trip_date,
            'durasi_perjalanan' => $request->trip_duration,
            'total_emisi_karbon' =>  $bahanBakar->emisi_karbon_permenit * $request->trip_duration,
        ]);

        return redirect('dashboard/perusahaan/perjalanan/edit/' . $id . '')->with('success', 'Data Successfully Updated');
    }
}
