<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\KirimEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Order;

class EmailController extends Controller
{
    public function kirim(Request $request){
        // $email = User::find($request->id);
        // $data = [
        //     'title' =>'Barang Telah di kirim',
        //     'url' => 'toystory.com'
        // ];
        // Mail::to($email)->send(new sendMail($data));
        // return 'Berhasil Mengirim Email';
    }

    public function index(Request $request){


        // $user_email = $request->input('email');
        $order_id = $request->input('id_order');
        $order = Order::with('customer', 'items')->find($order_id);

        $user_email = $order->customer->email;
    $tanggal_pembelian = $order->created_at;
    $nama_pengguna = $order->customer->name;
    $produk_dibeli = $order->items->nama_produk;

        $pesan = "<h1>Hai Terimah Kasih Telah Berbelanja Di Toko Kami</h1>";
        $pesan .= "Barang Pesanan Anda Telah Di Kirim Dan Sedang Dalam Perjalanan";

        $data_email = [
            'subject' => 'testing',
            'pengirim' => 'Toys_Store@gmail.com',
            'isi' => $pesan,
            'tgl_pembelian' => $tanggal_pembelian,
            'nama_user' => $nama_pengguna,
            'produk' => $produk_dibeli

        ];
        Mail::to($user_email)->send(new KirimEmail($data_email));
        return redirect()->back()->with('success', 'berhasil Mengirim Email');
    }

    // public function cariemail(Order $order, Request $request){
    //     $order = Order::find($order->id);
    //     $user_email = $order->customer->email;
    //     dd($user_email);
    // }
}
