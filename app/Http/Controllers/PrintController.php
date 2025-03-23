<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\PrintData;
use Illuminate\Support\Facades\DB;
use Exception;
use Session;

class PrintController extends Controller
{
    public function printGet(){
        return view('frontend.home');
    }

    // public function printPost(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'phone' => 'required',
    //         'data' => 'required',
    //     ]);

    //     try {
    //         $order = new PrintData();
    //         $order->name = $request->name;
    //         $order->phone = $request->phone;
    //         $order->data = $request->data;
    //         $order->save();

    //         $qrCode = base64_encode(QrCode::format('png')->size(100)->generate($request->phone));

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data created successfully.',
    //             'datas' => $order,
    //             'qrCode' => $qrCode
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred. Please try again.'
    //         ], 500);
    //     }
    // }

    public function printPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'data' => 'required',
        ]);

        DB::beginTransaction(); // Start transaction

        try {
            $order = new PrintData();
            $order->name = $request->name;
            $order->phone = $request->phone;
            $order->data = $request->data;
            $order->save();

            // Generate QR Code
            $qrCode = base64_encode(QrCode::format('png')->size(100)->generate($request->phone));

            // If everything is successful, commit the transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data created successfully.',
                'datas' => $order,
                'qrCode' => $qrCode
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback if any error occurs

            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.',
                'error' => $e->getMessage() // Debugging (remove in production)
            ], 500);
        }
    }

}
