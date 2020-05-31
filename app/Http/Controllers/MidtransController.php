<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TransactionSuccess;
use App\Transaction;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        //set konfigurasi midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // Buat Instance midtrans notification
        $notification = new Notification();

        // pecah order id
        $order = explode('-', $notification->order_id);

        // assign ke variable untuk memudahkan coding
        $status= $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $order[1];

        // cari transaksi berdasarkan id
        $transaction = Transaction::findOrFail($order_id);

        // Handle notification status midtrans
        if($status == 'capture'){
            if($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction->transaction_status = "CHALLENGE";
                } else {
                    $transaction->transaction_status = "SUCCESS";
                }
            }
        }

        else if($status == 'settlement'){
            $transaction->transaction_status = "SUCCESS";
        }
        else if($status == 'pending'){
            $transaction->transaction_status = "PENDING";
        }
        else if($status == 'deny'){
            $transaction->transaction_status = "FAILED";
        }
        else if($status == 'expire'){
            $transaction->transaction_status = "EXPIRED";
        }
        else if($status == 'cancel'){
            $transaction->transaction_status = "FAILED";
        }

        // simpan transaksi
        $transaction->save();

        // kirimkan email
        if($transaction)
        {
            if($status == 'capture' && $fraud == 'accept')
            {
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            }
            else if($status == 'settlement')
            {
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            }
            else if($status == 'success')
            {
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            }
           else if($status == 'capture' && $fraud == 'challenge')
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message'=> 'Midtrans Payment Challenge'
                    ]
                ]);
            }
            else
            {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message'=> 'Midtrans Payment Not Settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message'=> 'Midtrans Notification Success'
                ]
            ]);
        }

    }

    public function finishRedirect(Request $request)
    {
        return view('pages.success');
    }

    public function unfinishRedirect(Request $request)
    {
        return view('pages.unfinish');
    }

    public function errorRedirect(Request $request)
    {
        return view('pages.failed');
    }
}
