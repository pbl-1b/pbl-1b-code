<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class HomeController extends Controller
{
    public function index()
    {
        $dataService = Service::all();

        return view('home.app', ['services' => $dataService]);
    }
}
