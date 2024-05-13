<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Pemesanan;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customerView', compact('customers'));
    }

    public function fetchPemesanan($id)
    {
        $customer = Customer::findOrFail($id);
        $pemesanans = Pemesanan::where('id_customer', $id)->get();

        return view('admin.customerPemesananView', compact('customer', 'pemesanans'));
    }
}
