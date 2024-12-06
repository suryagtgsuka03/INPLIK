<?php

namespace App\Http\Controllers;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{

    // public function create(Request $request)
    // {

    //     \Midtrans\Config::$serverKey = 'SB-Mid-server-2KTxnogkMfz6bnhvzBHoxWIy';
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     \Midtrans\Config::$isProduction = false;
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;

    //     \Log::info($request->all()); // Log data yang diterima
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'price' => 'required|numeric|min:0',
    //         'email' => 'required|email',
    //         'tipe' => 'required|string|max:50',
    //     ]);
    
    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => Str::uuid(),
    //             'gross_amount' => $request->price,
    //         ],
    //         'customer_details' => [
    //             'name' => $request->name,
    //             'email' => $request->email,
    //         ],
    //     ];
    
    //     try {
    //         $snapToken = \Midtrans\Snap::getSnapToken($params);
    //         // Simpan data transaksi ke database
    //         Payments::create([
    //             'order_id' => $params['transaction_details']['order_id'],
    //             'status' => 'pending',
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'tipe' => $request->tipe,
    //             'price' => $request->price,
    //             'checkout_link' => $snapToken,
    //         ]);
    
    //         return view('public.berlangganan', compact('snapToken'));
    //     } catch (\Exception $e) {
    //         \Log::error('Database Error: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }
}