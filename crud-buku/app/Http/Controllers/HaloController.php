<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HaloController extends Controller
{
    function index()
    {
        $nama = 'Zufar';
        // pake compact
        return view('halo.templatehalo', compact('nama'));
    }
}
