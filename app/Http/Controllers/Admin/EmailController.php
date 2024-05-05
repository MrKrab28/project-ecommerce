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
    public function tes(Request $request){




        $order_id = $request->input('id_order');
        $order = Order::with('customer', 'items.product')->find($order_id);

        $user_email = $order->customer->email;


        $data_email = [
            'subject' => 'testing',
            'pengirim' => 'Toys_Store@gmail.com',
            'order' => $order


        ];
        Mail::to($user_email)->send(new KirimEmail($data_email));
        return view('mail.testes', $data_email );
    }

    public function index(Request $request){


        // $user_email = $request->input('email');
        $order_id = $request->input('id_order');
        $order = Order::with('customer', 'items.product')->find($order_id);

        $user_email = $order->customer->email;


        $data_email = [
            'subject' => 'testing',
            'pengirim' => 'Toys_Store@gmail.com',
            'order' => $order


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
