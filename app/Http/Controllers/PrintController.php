<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\PrintData;
use Exception;
use Session;

class PrintController extends Controller
{
    public function printGet(){
        return view('frontend.home');
    }

    public function printPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'data' => 'required',
        ]);

        try {
            $order = new PrintData();
            $order->name = $request->name;
            $order->phone = $request->phone;
            $order->data = $request->data;
            $order->save();
            return redirect()->route('print.data', $order->id)->with('success', 'Data created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('print.get')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function printData($id)
    {
        $order = PrintData::findOrFail($id);
        // $qrCode = base64_encode(QrCode::format('png')->size(100)->generate($order->phone));
        return view('frontend.print', compact('order'));
    }
}
