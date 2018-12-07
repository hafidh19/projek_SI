<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Menu;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function toko()
    {
        return view('admin.toko');
    }

    public function create(){
        $admins = Admin::all();
        return view('admin.menu',compact('admins'));
    }

    public function store(Request $request)
    {
        $this->validate(request(),[
            'nbarang'=>'required',
            'hbarang'=>'required|numeric',
            'deskripsi'=>'required',
            'gambar'=>'required|mimes:jpeg,png,bmp,tiff|max:4096',
        ]);

        Menu::create([
            'nbarang'=>request('nbarang'),
            'hbarang'=>request('hbarang'),
            'deskripsi'=>request('deskripsi'),
            $gambar=$request->file('gambar')->store('gambars'),
            'gambar'=>$gambar,
            'admin_id'=>request('admin_id')
        ]);
            
        return redirect('/admin/toko')->with('success','Data Berhasil Ditambahkan');
    }
}
