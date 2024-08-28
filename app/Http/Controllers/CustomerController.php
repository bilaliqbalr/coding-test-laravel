<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->filled('order_number')) {
            $query->whereHas('orders', function ($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->input('order_number') . '%');
            });
        }

        if ($request->filled('item_name')) {
            $query->whereHas('orders.items', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('item_name') . '%');
            });
        }

        $customers = $query->with('orders.items')->paginate(10);

        return view('customers.index', compact('customers'));
    }
}
