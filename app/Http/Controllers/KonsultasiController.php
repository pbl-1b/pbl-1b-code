<?php

namespace App\Http\Controllers;

use App\Models\HasilKonsultasi;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function index()
    {
        $konsultasis = HasilKonsultasi::latest()->paginate(5);
        $dataType = 'konsultasi';
        // $karyawans = PerjalananKaryawanPerusahaan::all();

        // return ($karyawans);
        return view('dashboardPerusahaan.layouts.konsultasi.view', ['data' => $konsultasis, 'dataType' => $dataType]);
    }

    public function add()
    {
        return view('dashboardPerusahaan.layouts.konsultasi.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'service_name' => 'required',
            'service_duration' => 'required',
            'service_price' => 'required',
            'service_description' => 'required',
        ]);

        // Simpan data ke database
        HasilKonsultasi::create([
            'nama_service' => $request->service_name,
            'durasi_service' => $request->service_duration,
            'harga_service' => $request->service_price,
            'deskripsi_service' => $request->service_description,
            'id_staff_mitra' => 1
        ]);

        return redirect('dashboard/perusahaan/konsultasi/add')->with('success', 'Data Successfully Added');
    }

    public function delete($id)
    {
        HasilKonsultasi::destroy($id);
        return redirect('dashboard/perusahaan/konsultasi')->with('success', 'Data Successfully Deleted');
    }

    public function edit($id)
    {

        $oldData = HasilKonsultasi::find($id);

        // return ($oldData);

        return view('dashboardPerusahaan.layouts.konsultasi.edit', ['oldData' => $oldData, 'id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'employee_name' => 'required',
            'position' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
        ]);

        HasilKonsultasi::where('id', $id)->update([
            'nama_service' => $request->service_name,
            'durasi_service' => $request->service_duration,
            'harga_service' => $request->service_price,
            'deskripsi_service' => $request->service_description,
        ]);

        return redirect('dashboard/perusahaan/konsultasi/edit/' . $id . '')->with('success', 'Data Successfully Updated');
    }

    public function restore(string $id)
    {
        HasilKonsultasi::withTrashed()->where('id', $id)->restore();
        return redirect('dashboard/perusahaan/konsultasi')->with('success', 'Data Successfully Restored');
    }
}
