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
    public function index()
    {
        $perjalanans = PerjalananKaryawanPerusahaan::latest()->paginate(5);
        $dataType = 'perjalanan';
        // $perjalanans = PerjalananKaryawanPerusahaan::all();

        // return ($perjalanans);
        return view('dashboardPerusahaan.layouts.perjalananKaryawanPerusahaan.view', ['data' => $perjalanans, 'dataType' => $dataType]);
    }

    public function add()
    {
        $transportasis = Transportasi::all();
        $bahanbakars = BahanBakar::all();
        $alamats = AlamatRumah::all();
        $karyawans = KaryawanPerusahaan::all();

        return view('dashboardPerusahaan.layouts.perjalananKaryawanPerusahaan.add', ['dataTransportasi' => $transportasis, 'dataBahanBakar' => $bahanbakars, 'dataAlamat' => $alamats, 'dataKaryawan' => $karyawans]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'employee_name' => 'required',
            'transportation' => 'required',
            'fuel' => 'required',
            'address' => 'required',
            'trip_date' => 'required',
            'trip_duration' => 'required',
        ]);

        $bahanBakar = BahanBakar::find($request->fuel);

        PerjalananKaryawanPerusahaan::create([
            'id_karyawan' => $request->employee_name,
            'id_transportasi' => $request->transportation,
            'id_bahan_bakar' => $request->fuel,
            'id_perusahaan' => 1,
            'id_alamat' => $request->address,
            'tanggal_perjalanan' => $request->trip_date,
            'durasi_perjalanan' => $request->trip_duration,
            'total_emisi_karbon' =>  $bahanBakar->emisi_karbon_permenit * $request->trip_duration,
        ]);

        return redirect('dashboard/perusahaan/perjalanan/add')->with('success', 'Data Successfully Added');
    }

    public function delete($id)
    {
        PerjalananKaryawanPerusahaan::destroy($id);
        return redirect('dashboard/perusahaan/perjalanan')->with('success', 'Data Successfully Deleted');
    }

    public function edit($id)
    {
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
