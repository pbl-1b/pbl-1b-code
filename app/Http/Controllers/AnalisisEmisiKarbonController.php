<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalisisEmisiKarbonController extends Controller
{
    public function index()
    {
        Controller::checkifLoginForCompany();
    }
}
