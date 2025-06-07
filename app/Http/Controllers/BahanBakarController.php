<?php

namespace App\Http\Controllers;

use App\Models\BahanBakar;
use Illuminate\Http\Request;

class BahanBakarController extends Controller
{
    public function index()
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        $bahanBakars = BahanBakar::latest()->paginate(5);
        $dataType = 'bahanBakar';
        // $bahanBakars = PerjalananKaryawanPerusahaan::all();

        // return ($alamats);
        return view('dashboardStaff.layouts.bahanBakar.view', ['data' => $bahanBakars, 'dataType' => $dataType]);
    }

    public function add()
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        return view('dashboardStaff.layouts.bahanBakar.add');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        $validatedData = $request->validate([
            'fuel_name' => 'required',
            'emission' => 'required',
            'cost' => 'required',
        ]);

        bahanBakar::create([
            'nama_bahan_bakar' => $request->fuel_name,
            'jenis_bahan_bakar' => '-',
            'emisi_karbon_permenit' => $request->emission,
            'harga_bahan_bakar_per_liter' => $request->cost,
        ]);

        return redirect('dashboard/staff/bahanBakar/add')->with('success', 'Data Successfully Added');
    }

    public function delete($id)
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        BahanBakar::destroy($id);
        return redirect('dashboard/staff/bahanBakar')->with('success', 'Data Successfully Deleted');
    }

    public function edit($id)
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        $oldData = BahanBakar::find($id);

        // return ($oldData);

        return view('dashboardStaff.layouts.bahanBakar.edit', ['oldData' => $oldData, 'id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        $validatedData = $request->validate([
            'fuel_name' => 'required',
            'emission' => 'required',
            'cost' => 'required',
        ]);

        BahanBakar::where('id', $id)->update([
            'nama_bahan_bakar' => $request->fuel_name,
            'jenis_bahan_bakar' => '-',
            'emisi_karbon_permenit' => $request->emission,
            'harga_bahan_bakar_per_liter' => $request->cost,
        ]);

        return redirect('dashboard/staff/bahanBakar/edit/' . $id . '')->with('success', 'Data Successfully Updated');
    }

    public function restore(string $id)
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        BahanBakar::withTrashed()->where('id', $id)->restore();
        return redirect('dashboard/staff/bahanBakar')->with('success', 'Data Successfully Restored');
    }
}
