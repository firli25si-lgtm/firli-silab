<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    // Menampilkan katalog guest menggunakan Query Builder Join
    public function index()
{
    $items = DB::table('items')
        ->join('categories', 'items.category_id', '=', 'categories.id')
        ->select('items.*', 'categories.nama as category_name') // Sesuaikan 'nama' dengan nama kolom asli di database
        ->get();

    return view('guest.index', compact('items'));
}
}