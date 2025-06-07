<?php

namespace App\Http\Controllers;

use App\Models\KaryawanPerusahaan;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        $services = Service::latest()->paginate(5);
        $dataType = 'service';
        // $services = PerjalananKaryawanPerusahaan::all();

        // return ($services);
        return view('dashboardStaff.layouts.service.view', ['data' => $services, 'dataType' => $dataType]);
    }

    public function add()
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        return view('dashboardStaff.layouts.service.add');
    }

    public function store(Request $request)
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        $validatedData = $request->validate([
            'service_name' => 'required',
            'service_duration' => 'required',
            'service_price' => 'required',
            'service_description' => 'required',
            'service_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = null;

        if ($request->hasFile('service_image')) {
            $image = $request->file('service_image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            // Simpan langsung ke public/service_images
            $image->move(public_path('service_images'), $imageName);
        }

        // Simpan data ke database
        Service::create([
            'nama_service' => $request->service_name,
            'durasi_service' => $request->service_duration,
            'harga_service' => $request->service_price,
            'deskripsi_service' => $request->service_description,
            'image_service' => $imageName,
            'id_staff_mitra' => 1
        ]);

        return redirect('dashboard/staff/service/add')->with('success', 'Data Successfully Added');
    }

    public function delete($id)
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        Service::destroy($id);
        return redirect('dashboard/staff/service')->with('success', 'Data Successfully Deleted');
    }

    public function edit($id)
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        $karyawans = KaryawanPerusahaan::all();

        $oldData = Service::find($id);

        // return ($oldData);

        return view('dashboardStaff.layouts.service.edit', ['dataKaryawan' => $karyawans, 'oldData' => $oldData, 'id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        $validatedData = $request->validate([
            'service_name' => 'required',
            'service_duration' => 'required',
            'service_price' => 'required',
            'service_description' => 'required',
            'service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // nullable karena bisa tidak update gambar
        ]);

        $service = Service::findOrFail($id);

        // Jika ada file gambar baru yang diupload
        if ($request->hasFile('service_image')) {
            // Hapus gambar lama jika ada
            if ($service->image_service && file_exists(public_path('service_images/' . $service->image_service))) {
                unlink(public_path('service_images/' . $service->image_service));
            }

            $image = $request->file('service_image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();

            // Simpan gambar baru
            $image->move(public_path('service_images'), $imageName);

            $service->image_service = $imageName;
        }

        // Update data lain
        $service->nama_service = $request->service_name;
        $service->durasi_service = $request->service_duration;
        $service->harga_service = $request->service_price;
        $service->deskripsi_service = $request->service_description;

        $service->save();

        return redirect('dashboard/staff/service/edit/' . $id)->with('success', 'Data Successfully Updated');
    }

    public function restore(string $id)
    {
        if ($redirect = $this->checkifLoginForStaff()) return $redirect;
        Service::withTrashed()->where('id', $id)->restore();
        return redirect('dashboard/perusahaan/service')->with('success', 'Data Successfully Restored');
    }
}
