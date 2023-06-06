<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class ProductsController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param null
     * @return View
     */
    public function show()
    {
        $posts = \App\Products::all();
        //'id': 0, 'name': '', 'email': '', 'phone_number': ''

        return view('products', ['info' => [],'posts' => $posts]);
    }

    public function edit($id = '')
    {
        $info = \App\Products::findOrFail($id);

        return view('products', ['info' => $info, 'posts' => []]);
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $post = \App\Products::find($request->id);
            $post->name = $request->name;
            $post->description = $request->description;
            $post->price = $request->price;
            $post->stock = $request->stock;
            $post->save();
            return redirect('products')->with('status', 'Producto actualizado exitosamente');
        } else {
            $post = new Products;
            $post->name = $request->name;
            $post->description = $request->description;
            $post->price = $request->price;
            $post->stock = $request->stock;
            $post->save();
            return redirect('products')->with('status', 'Nuevo Producto creado exitosamente');
        }
    }
}
