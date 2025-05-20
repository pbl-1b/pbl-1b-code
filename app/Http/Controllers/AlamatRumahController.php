<?php

namespace App\Http\Controllers;

use App\Models\AlamatRumah;
use App\Models\KaryawanPerusahaan;

use Illuminate\Http\Request;

class AlamatRumahController extends Controller
{
    public function index()
    {
        $alamats = AlamatRumah::latest()->paginate(5);
        $dataType = 'alamat';
        // $alamats = PerjalananKaryawanPerusahaan::all();

        // return ($alamats);
        return view('dashboardPerusahaan.layouts.alamatRumah.view', ['data' => $alamats, 'dataType' => $dataType]);
    }

    public function add()
    {
        $karyawans = KaryawanPerusahaan::all();

        return view('dashboardPerusahaan.layouts.alamatRumah.add', ['dataKaryawan' => $karyawans]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'employee_name' => 'required',
            'address' => 'required'
        ]);

        AlamatRumah::create([
            'id_karyawan' => $request->employee_name,
            'alamat_rumah' => $request->address
        ]);

        return redirect('dashboard/perusahaan/alamat/add')->with('success', 'Data Successfully Added');
    }

    public function delete($id)
    {
        AlamatRumah::destroy($id);
        return redirect('dashboard/perusahaan/alamat')->with('success', 'Data Successfully Deleted');
    }

    public function edit($id)
    {
        $karyawans = KaryawanPerusahaan::all();

        $oldData = AlamatRumah::find($id);

        // return ($oldData);

        return view('dashboardPerusahaan.layouts.alamatRumah.edit', ['dataKaryawan' => $karyawans, 'oldData' => $oldData, 'id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'employee_name' => 'required',
            'address' => 'required'
        ]);

        AlamatRumah::where('id', $id)->update([
            'id_karyawan' => $request->employee_name,
            'alamat_rumah' => $request->address
        ]);

        return redirect('dashboard/perusahaan/alamat/edit/' . $id . '')->with('success', 'Data Successfully Updated');
    }

    public function restore(string $id)
    {
        AlamatRumah::withTrashed()->where('id', $id)->restore();
        return redirect('dashboard/perusahaan/alamat')->with('success', 'Data Successfully Restored');
    }
}
