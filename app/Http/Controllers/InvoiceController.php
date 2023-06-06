<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoices;
use App\Products;
use App\Clients;

class InvoiceController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param null
     * @return View
     */
    public function show()
    {
        $posts = \App\Invoices::all();
        //'id': 0, 'name': '', 'email': '', 'phone_number': ''
        $clients = \App\Clients::all();
        $products = \App\Products::all();

        return view('invoices', ['info' => [],'posts' => $posts, 'products' => $products, 'clients' => $clients]);
    }

    public function edit($id = '')
    {
        $info = \App\Invoices::findOrFail($id);
        $clients = \App\Clients::all();
        $products = \App\Products::all();

        return view('invoices', ['info' => $info, 'posts' => [], 'products' => $products, 'clients' => $clients]);
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $post = \App\Invoices::find($request->id);
            $post->name = $request->name;
            $post->email = $request->email;
            $post->phone_number = $request->phonenumber;
            $post->save();
            return redirect('invoices')->with('status', 'Factura actualizado exitosamente');
        } else {
            $post = new Invoices;
            $post->name = $request->name;
            $post->email = $request->email;
            $post->phone_number = $request->phonenumber;
            $post->save();
            return redirect('invoices')->with('status', 'Nueva Factura creado exitosamente');
        }
    }
}
