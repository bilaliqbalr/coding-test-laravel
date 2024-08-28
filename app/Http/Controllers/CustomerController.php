<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        // validating data
        $data = $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'order_number' => 'nullable|string',
            'item_name' => 'nullable|string',
        ]);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $data['email'] . '%');
        }

        if ($request->filled('order_number')) {
            $query->whereHas('orders', function ($q) use ($request, $data) {
                $q->where('order_number', 'like', '%' . $data['order_number'] . '%');
            });
        }

        if ($request->filled('item_name')) {
            $query->whereHas('orders.items', function ($q) use ($request, $data) {
                $q->where('name', 'like', '%' . $data['item_name'] . '%');
            });
        }

        $customers = $query->with('orders.items')->paginate(10);

        return view('customers.index', compact('customers'));
    }
}
