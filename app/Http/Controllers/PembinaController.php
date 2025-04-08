<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Ekskul;

class PembinaController extends Controller
{
     public function index()
    {
        $pembina_id = Auth::id();
        $ekskuls = Ekskul::where('pembina_id', $pembina_id)->get();

        return view('pembina.dashboard.index', compact('ekskuls'));
    }
}