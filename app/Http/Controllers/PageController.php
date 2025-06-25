<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Tampilkan halaman "Tentang Kami".
     *
     * @return \Illuminate\View\View
     */
    public function team()
    {
        return view('team');
    }
}
