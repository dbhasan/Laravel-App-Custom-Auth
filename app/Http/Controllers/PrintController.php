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
            $data = new PrintData();
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->data = $request->data;
            $data->save();
            return redirect()->route('print.get')->with('success', 'Data created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('print.get')->with('error', 'An error occurred. Please try again.');
        }
    }
}
