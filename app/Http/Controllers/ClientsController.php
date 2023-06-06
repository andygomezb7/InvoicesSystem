<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;


class ClientsController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param null
     * @return View
     */
    public function show()
    {
        $posts = \App\Clients::all();
        //'id': 0, 'name': '', 'email': '', 'phone_number': ''

        return view('clients', ['info' => [],'posts' => $posts]);
    }

    public function edit($id = '')
    {
        $info = \App\Clients::findOrFail($id);

        return view('clients', ['info' => $info, 'posts' => []]);
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $post = \App\Clients::find($request->id);
            $post->name = $request->name;
            $post->email = $request->email;
            $post->phone_number = $request->phonenumber;
            $post->save();
            return redirect('clients')->with('status', 'Cliente actualizado exitosamente');
        } else {
            $post = new Clients;
            $post->name = $request->name;
            $post->email = $request->email;
            $post->phone_number = $request->phonenumber;
            $post->save();
            return redirect('clients')->with('status', 'Nuevo cliente creado exitosamente');
        }
    }
}
