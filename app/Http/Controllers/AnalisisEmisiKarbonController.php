<?php

namespace App\Http\Controllers;

use App\Models\BahanBakar;
use App\Models\HasilAnalisisEmisi;
use App\Models\KaryawanPerusahaan;
use App\Models\PerjalananKaryawanPerusahaan;
use App\Models\Perusahaan;
use App\Models\StaffPerusahaan;
use App\Models\Transportasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

// use Barryvdh\DomPDF\PDF as PDF;

class AnalisisEmisiKarbonController extends Controller
{
    public function index()
    {
        if ($redirect = $this->checkifLoginForCompany()) {
            return $redirect;
        }
        $analisis = HasilAnalisisEmisi::latest()->paginate(5);
        $dataType = 'analisis';
        // $perjalanans = PerjalananKaryawanPerusahaan::all();

        // return ($perjalanans);
        return view('dashboardPerusahaan.layouts.analisisEmisiKarbon.view', ['data' => $analisis, 'dataType' => $dataType]);
    }

    public function add()
    {
        if ($redirect = $this->checkifLoginForCompany()) {
            return $redirect;
        }
        // $transportasis = Transportasi::all();
        // $bahanbakars = BahanBakar::all();
        // $alamats = AlamatRumah::all();
        // $karyawans = KaryawanPerusahaan::all();

        // return view('dashboardPerusahaan.layouts.perjalananKaryawanPerusahaan.add', ['dataTransportasi' => $transportasis, 'dataBahanBakar' => $bahanbakars, 'dataAlamat' => $alamats, 'dataKaryawan' => $karyawans]);
    }

    public function store(Request $request)
    {
        if ($redirect = $this->checkifLoginForCompany()) {
            return $redirect;
        }
        // $validatedData = $request->validate([
        //     'employee_name' => 'required',
        //     'transportation' => 'required',
        //     'fuel' => 'required',
        //     'address' => 'required',
        //     'trip_date' => 'required',
        //     'trip_duration' => 'required',
        // ]);

        // // Cek duplikat berdasarkan nama karyawan dan tanggal perjalanan
        // $existing = PerjalananKaryawanPerusahaan::where('id_karyawan', $request->employee_name)
        //     ->where('tanggal_perjalanan', $request->trip_date)
        //     ->first();

        // if ($existing) {
        //     return redirect('dashboard/perusahaan/perjalanan/add')
        //         ->with('failed', 'Data sudah ada (data duplikat)');
        // }

        // $bahanBakar = BahanBakar::find($request->fuel);

        // PerjalananKaryawanPerusahaan::create([
        //     'id_karyawan' => $request->employee_name,
        //     'id_transportasi' => $request->transportation,
        //     'id_bahan_bakar' => $request->fuel,
        //     'id_perusahaan' => 1,
        //     'id_alamat' => $request->address,
        //     'tanggal_perjalanan' => $request->trip_date,
        //     'durasi_perjalanan' => $request->trip_duration,
        //     'total_emisi_karbon' => $bahanBakar->emisi_karbon_permenit * $request->trip_duration,
        // ]);

        // return redirect('dashboard/perusahaan/perjalanan/add')->with('success', 'Data Successfully Added');
    }

    public function delete($id)
    {
        if ($redirect = $this->checkifLoginForCompany()) {
            return $redirect;
        }
        // PerjalananKaryawanPerusahaan::destroy($id);
        // return redirect('dashboard/perusahaan/perjalanan')->with('success', 'Data Successfully Deleted');
    }

    public function destroy($id)
    {
        if ($redirect = $this->checkifLoginForCompany()) {
            return $redirect;
        }
        // PerjalananKaryawanPerusahaan::findOrFail($id)->delete();

        // return redirect()->back()->with('deleted', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        if ($redirect = $this->checkifLoginForCompany()) {
            return $redirect;
        }
        // $transportasis = Transportasi::all();
        // $bahanbakars = BahanBakar::all();
        // $alamats = AlamatRumah::all();
        // $karyawans = KaryawanPerusahaan::all();

        // $oldData = PerjalananKaryawanPerusahaan::find($id);

        // // return ($oldData);

        // return view('dashboardPerusahaan.layouts.perjalananKaryawanPerusahaan.edit', ['dataTransportasi' => $transportasis, 'dataBahanBakar' => $bahanbakars, 'dataAlamat' => $alamats, 'dataKaryawan' => $karyawans, 'oldData' => $oldData, 'id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        if ($redirect = $this->checkifLoginForCompany()) {
            return $redirect;
        }
        // $validatedData = $request->validate([
        //     'employee_name' => 'required',
        //     'transportation' => 'required',
        //     'fuel' => 'required',
        //     'address' => 'required',
        //     'trip_date' => 'required',
        //     'trip_duration' => 'required',
        // ]);

        // $bahanBakar = BahanBakar::find($request->fuel);

        // PerjalananKaryawanPerusahaan::where('id', $id)->update([
        //     'id_karyawan' => $request->employee_name,
        //     'id_transportasi' => $request->transportation,
        //     'id_bahan_bakar' => $request->fuel,
        //     'id_perusahaan' => 1,
        //     'id_alamat' => $request->address,
        //     'tanggal_perjalanan' => $request->trip_date,
        //     'durasi_perjalanan' => $request->trip_duration,
        //     'total_emisi_karbon' =>  $bahanBakar->emisi_karbon_permenit * $request->trip_duration,
        // ]);

        // return redirect('dashboard/perusahaan/perjalanan/edit/' . $id . '')->with('success', 'Data Successfully Updated');
    }

    public function viewAnalisis(Request $request)
    {
        if ($redirect = $this->checkifLoginForCompany()) {
            return $redirect;
        }

        $query = PerjalananKaryawanPerusahaan::query();

        // Filter nama_karyawan
        if ($request->filled('nama_karyawan')) {
            $query->whereHas('karyawanPerusahaan', function ($q) use ($request) {
                $q->where('nama_karyawan', 'like', '%'.$request->nama_karyawan.'%');
            });
        }

        // Filter nama_bahan_bakar
        if ($request->filled('nama_bahan_bakar')) {
            $query->whereHas('bahanBakar', function ($q) use ($request) {
                $q->where('nama_bahan_bakar', 'like', '%'.$request->nama_bahan_bakar.'%');
            });
        }

        // Filter nama_transportasi
        if ($request->filled('nama_transportasi')) {
            $query->whereHas('transportasi', function ($q) use ($request) {
                $q->where('nama_transportasi', 'like', '%'.$request->nama_transportasi.'%');
            });
        }

        // Filter tanggal_perjalanan
        if ($request->filled('tanggal_perjalanan')) {
            $query->whereDate('tanggal_perjalanan', $request->tanggal_perjalanan);
        }

        $query->orderBy('tanggal_perjalanan', 'desc');

        $perjalanans = $query->paginate(5);

        $karyawans     = KaryawanPerusahaan::all();
        $bahanbakars   = BahanBakar::all();
        $transportasis = Transportasi::all();

        return view('dashboardPerusahaan.layouts.analisisEmisiKarbon.analisis', [
            'dataKaryawan' => $karyawans,
            'dataBahanBakar' => $bahanbakars,
            'dataTransportasi' => $transportasis,
            'data' => $perjalanans,
            'dataType' => 'perjalanan',
            'request' => $request,
        ]);
    }

    public function prosesAnalisis(Request $request)
    {
        // Validasi input nama_analisis
        $request->validate([
            'nama_analisis' => 'required|string|max:255',
        ]);

        $filters = [
            'nama_karyawan' => $request->input('nama_karyawan'),
            'nama_transportasi' => $request->input('nama_transportasi'),
            'nama_bahan_bakar' => $request->input('nama_bahan_bakar'),
            'tanggal_perjalanan' => $request->input('tanggal_perjalanan'),
        ];

        $query = PerjalananKaryawanPerusahaan::with(['karyawanPerusahaan', 'bahanBakar', 'transportasi', 'alamat']);

        if (! empty($filters['nama_karyawan'])) {
            $query->whereHas('karyawanPerusahaan', fn ($q) => $q->where('nama_karyawan', 'like', '%'.$filters['nama_karyawan'].'%'));
        }
        if (! empty($filters['nama_bahan_bakar'])) {
            $query->whereHas('bahanBakar', fn ($q) => $q->where('nama_bahan_bakar', 'like', '%'.$filters['nama_bahan_bakar'].'%'));
        }
        if (! empty($filters['nama_transportasi'])) {
            $query->whereHas('transportasi', fn ($q) => $q->where('nama_transportasi', 'like', '%'.$filters['nama_transportasi'].'%'));
        }
        if (! empty($filters['tanggal_perjalanan'])) {
            $query->whereDate('tanggal_perjalanan', $filters['tanggal_perjalanan']);
        }

        if ($query->count() == 0) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data = $query->get();

        $analysisName = $request->input('nama_analisis');

        $staff = StaffPerusahaan::where('id', session('id'))->first();
        if (! $staff) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        $company     = Perusahaan::find($staff->id_perusahaan);
        $companyName = $company ? $company->nama_perusahaan : 'Unknown';

        // Buat PDF
        $pdf = Pdf::loadView('dashboardPerusahaan.layouts.analisisEmisiKarbon.pdf', compact('data', 'filters', 'analysisName', 'companyName'))
            ->setPaper('a4', 'portrait');

        // Buat folder jika belum ada
        $directory = public_path('analysis');
        if (! File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Buat nama file unik
        $fileName = 'analisis_emisi_'.Str::random(10).'.pdf';
        $filePath = $directory.'/'.$fileName;

        // Simpan file PDF
        file_put_contents($filePath, $pdf->output());

        // Simpan ke database
        HasilAnalisisEmisi::create([
            'nama_analisis' => $analysisName,
            'id_perusahaan' => $staff->id_perusahaan,
            'tanggal_analisis' => Carbon::now(),
            'file_pdf' => $fileName,
        ]);

        // Pilihan 1: Langsung download file
        // return response()->download($filePath)->deleteFileAfterSend(false);

        // Pilihan 2: Redirect dan berikan link download di halaman lain
        return redirect()->route('analisis.viewAnalisis')->with('analisis_berhasil', true);
    }
}
