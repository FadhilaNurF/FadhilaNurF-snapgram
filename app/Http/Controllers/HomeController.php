<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //menampilkan halaman utama dgn daftar foto
    public function index() {
        $photos = Photo::all();
        return view('home', compact('photos'));
    }
}