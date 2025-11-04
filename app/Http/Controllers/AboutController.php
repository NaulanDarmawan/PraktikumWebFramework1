<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        return "NIM = 23.51.0001, Nama = Naulan Darmawan";
    }
}
