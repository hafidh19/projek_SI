<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Menu;
use App\Transaksi;
use App\User;
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
        $menus=Menu::all();
        return view('admin.toko',compact('menus'));
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
            $gambar=$request->file('gambar'),
            $fileNama=$gambar->getClientOriginalName(),
            $request->file('gambar')->move("storage/",$fileNama),
            'gambar'=>$fileNama,
            'admin_id'=>request('admin_id')
        ]);
            
        return redirect('/admin/toko')->with('success','Menu Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        
        $admins = Admin::all();
        $menu = Menu::find($id);
        return view('admin.editmenu', compact('menu','admins'));
    }

    public function update($id,Request $request)
    {   
        $this->validate(request(),[
            'nbarang'=>'required',
            'hbarang'=>'required|numeric',
            'deskripsi'=>'required',
            'gambar'=>'required|image',
        ]);      

        $menu = Menu::find($id);
        $admins = Admin::all();
        $menu -> update([
            'nbarang'=>request('nbarang'),
            'hbarang'=>request('hbarang'),
            'deskripsi'=>request('deskripsi'),
            $gambar=$request->file('gambar'),
            $fileNama=$gambar->getClientOriginalName(),
            $request->file('gambar')->move("storage/",$fileNama),
            'gambar'=>$fileNama,
            'admin_id'=>request('admin_id')
        ]);
        return redirect('/admin/toko')->with('success','Menu Berhasil Di Edit');
    }

    public function destroy($id){
        $menu = Menu::find($id);
        $menu->delete();
        return redirect('/admin/toko')->with('danger','Menu Berhasil Di Delete');
    }

    public function order(){
        $transaksis = Transaksi::all();
        $menus = Menu::all();
        $users = User::all();
        return view('/admin/ongoingorder',compact('transaksis','menus','users'));
    }

    public function done(){
        $post = Transaksi::where('status','1')->first();
        $post->status = 2;
        $post->save();
        return redirect('/admin/order')->with('success','Orderan Telah Selesai');
    }

    public function orderdone(){
        $transaksis = Transaksi::all();
        $menus = Menu::all();
        $users = User::all();
        return view('/admin/orderdone',compact('transaksis','menus','users'));
    }


    public function message(Request $request)
    {
        $this->validate(request(),[
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required'
        ]);

        Message::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'subject'=>request('subject'),
            'message'=>request('message')
        ]);
            
        return redirect('/')->with('success','Pesan Terkirim');
    }
}
