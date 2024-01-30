<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function reservation()
    {
        $data['title'] = 'Tambah Siswa';

        return view('templates.header', $data)
            ->with('sidebar', view('templates.sidebar', $data))
            ->with('content', view('tambah_siswa'))
            ->with('footer', view('templates.footer'));
    }
}


