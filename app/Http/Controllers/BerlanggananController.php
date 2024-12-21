<?php

namespace App\Http\Controllers;

use App\Models\Berlangganan;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class BerlanggananController extends Controller
{
    public function index()
    {
        $langganans = Berlangganan::all();
        return view('private.berlangganan', compact('langganans'));
    }
    
    public function public()
    {
        $user = auth()->user();
    
        if (in_array($user->status, ['Premium', 'Basic'])) {
            return redirect()->route('dashboard')->with('message', 'Anda sudah berlangganan.');
        }
    
        $langganans = Berlangganan::all();
        $snapToken = '';
        return view('public.berlangganan', compact('langganans', 'snapToken'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe_langganan' => 'required|string|max:20',
            'harga' => 'required|integer',
            'manfaat' => 'required|string|max:100',
        ]);
    
        try {
            Berlangganan::create([
                'tipe' => $request->tipe_langganan,
                'harga' => $request->harga,
                'benefit' => $request->manfaat,
            ]);            
            return redirect()->route('berlangganan.index')->with('status', 'Langganan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi Kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        $validated = $request->validate([
            'tipe_langganan' => 'required|string|max:255',
            'manfaat' => 'required|string',
            'harga' => 'required|numeric',
        ]);

        try {
            $langganan = Berlangganan::findOrFail($id);
            $langganan->update([
                'tipe' => $validated['tipe_langganan'],
                'benefit' => $validated['manfaat'],
                'harga' => $validated['harga'],
            ]);

            return redirect()->route('berlangganan.index')->with('status', 'success')->with('message', 'Data langganan berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->route('berlangganan.index')->with('status', 'error')->with('message', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    public function delete($id)
    {
        try {
            $langganan = Berlangganan::findOrFail($id);
            $langganan->delete();

            return redirect()->route('berlangganan.index')->with('status', 'Tipe Langganan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('berlangganan.index')->with('error', 'Terjadi kesalahan :' . $e->getMessage());
        }
    }
    public function createPayment(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'price' => 'required|numeric',
            'tipe' => 'required|string',
        ]);

        try {
            $order_id = 'order-' . time() . '-' . rand(1000, 9999);

            $payment = Payments::create([
                'order_id' => $order_id,
                'status' => 'pending',
                'name' => $request->name,
                'email' => $request->email,
                'tipe' => $request->tipe,
                'price' => $request->price,
                'checkout_link' => '',
            ]);

            Log::info('Data pembayaran disimpan ke database:', $payment->toArray());

            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $transactionDetails = [
                'order_id' => $order_id,
                'gross_amount' => $request->price,
            ];

            $itemDetails = [
                [
                    'id' => 'item-' . $order_id,
                    'price' => $request->price,
                    'quantity' => 1,
                    'name' => $request->tipe,
                ],
            ];

            $customerDetails = [
                'first_name' => $request->name,
                'email' => $request->email,
            ];

            $transaction = [
                'transaction_details' => $transactionDetails,
                'item_details' => $itemDetails,
                'customer_details' => $customerDetails,
            ];

            $snapToken = Snap::getSnapToken($transaction);

            $payment->update([
                'checkout_link' => $snapToken,
            ]);

            Log::info('Snap Token berhasil didapatkan:', ['snapToken' => $snapToken]);

            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan saat memproses pembayaran:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'transaction_status' => 'required|string',
        ]);
    
        try {
            $payment = Payments::where('order_id', $request->order_id)->firstOrFail();
            $payment->update([
                'status' => $request->transaction_status,
            ]);
    
            if ($request->transaction_status === 'sukses') {
                User::where('email', $payment->email)->update([
                    'status' => $payment->tipe,
                ]);
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Status pembayaran berhasil diperbarui.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}