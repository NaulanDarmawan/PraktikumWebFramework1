<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        // --- PRAKTIK INSERT DATA ---
        // DB::insert('insert into m_level (level_kode, level_nama, created_at) values (?, ?, ?)', ['CUS', 'Pelanggan', now()]);
        // return "Insert Data Baru Berhasil";

        // --- PRAKTIK UPDATE DATA ---
        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return "Update Data Berhasil. Jumlah Data Yang Diupdate: $row Baris";

        // --- PRAKTIK DELETE DATA ---
        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return "Delete Data Berhasil. Jumlah Data Yang Dihapus: $row Baris";

        // --- PRAKTIK SELECT DATA ---
        $data = DB::select('select * from m_level');
        return view("level", ["data" => $data]);
    }
}
