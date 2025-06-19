<?php

namespace App\Http\Controllers;

use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $dataService = Service::all();

        return view('home.app', ['services' => $dataService]);
    }
}
