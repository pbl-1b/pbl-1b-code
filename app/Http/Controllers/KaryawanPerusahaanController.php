<?php

namespace App\Http\Controllers;

use App\Models\KaryawanPerusahaan;
use Illuminate\Http\Request;

class KaryawanPerusahaanController extends Controller
{
    public function index()
    {
        $karyawans = KaryawanPerusahaan::latest()->paginate(5);
        $dataType = 'karyawan';
        // $karyawans = PerjalananKaryawanPerusahaan::all();

        // return ($karyawans);
        return view('dashboardPerusahaan.layouts.karyawan.view', ['data' => $karyawans, 'dataType' => $dataType]);
    }

    // public function add()
    // {
    //     return view('dashboardPerusahaan.layouts.karyawan.add');
    // }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'service_name' => 'required',
    //         'service_duration' => 'required',
    //         'service_price' => 'required',
    //         'service_description' => 'required',
    //     ]);

    //     // Simpan data ke database
    //     KaryawanPerusahaan::create([
    //         'nama_service' => $request->service_name,
    //         'durasi_service' => $request->service_duration,
    //         'harga_service' => $request->service_price,
    //         'deskripsi_service' => $request->service_description,
    //         'id_staff_mitra' => 1
    //     ]);

    //     return redirect('dashboard/perusahaan/karyawan/add')->with('success', 'Data Successfully Added');
    // }

    public function delete($id)
    {
        KaryawanPerusahaan::destroy($id);
        return redirect('dashboard/perusahaan/karyawan')->with('success', 'Data Successfully Deleted');
    }

    public function edit($id)
    {

        $oldData = KaryawanPerusahaan::find($id);

        // return ($oldData);

        return view('dashboardPerusahaan.layouts.karyawan.edit', ['oldData' => $oldData, 'id' => $id]);
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

        KaryawanPerusahaan::where('id', $id)->update([
            'nama_karyawan' => $request->employee_name,
            'jabatan' => $request->position,
            'email' => $request->email,
            'jenis_kelamin' => $request->gender,
            'tanggal_lahir' => $request->birth_date,
        ]);

        return redirect('dashboard/perusahaan/karyawan/edit/' . $id . '')->with('success', 'Data Successfully Updated');
    }

    public function restore(string $id)
    {
        KaryawanPerusahaan::withTrashed()->where('id', $id)->restore();
        return redirect('dashboard/perusahaan/service')->with('success', 'Data Successfully Restored');
    }
}
