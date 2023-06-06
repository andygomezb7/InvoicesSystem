@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="row">
                <div class="display-4 float-left" style="font-size: 32px;border-bottom: 4px solid #3490dc;margin: 0 0 10px 0;">
                    @if ($info)
                        Editar Cliente
                    @else
                        Crear Cliente
                    @endif
                </div>
            </div>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="needs-validation" method="POST" action="{{url('clients-form')}}" novalidate="">
                @csrf <!-- {{ csrf_field() }} -->
            @if ($info)
            <input type="hidden" name="id" value="{{ $info->id }}" />
            <div class="mb-3">
              <label for="username">Nombre</label>
              <div class="input-group">
                <input type="text" name="name" class="form-control" id="username" value="{{ $info->name }}" placeholder="Username" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El nombre del cliente es obligatorio.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Correo electronico</label>
              <input type="email" name="email" value="{{ $info->email }}" class="form-control" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="username">Numero de telefono</label>
              <div class="input-group">
                <input type="text" name="phonenumber" value="{{ $info->phone_number }}" class="form-control" id="username" placeholder="Username" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El numero de telefono es obligatorio.
                </div>
              </div>
            </div>
            @else
            <div class="mb-3">
              <label for="username">Nombre</label>
              <div class="input-group">
                <input type="text" name="name" class="form-control" id="username"  placeholder="Username" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El nombre del cliente es obligatorio.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Correo electronico</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="username">Numero de telefono</label>
              <div class="input-group">
                <input type="text" name="phonenumber" class="form-control" id="username" placeholder="Username" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El numero de telefono es obligatorio.
                </div>
              </div>
            </div>
            @endif

            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" type="submit">
                @if ($info)
                    Actualizar cliente
                @else
                    Crear cliente
                @endif
            </button>
          </form>
            
        </div>

        @if ($posts)
        <div class="col-md-12 mt-5 pt-5">

            <div class="display-4 float-left" style="font-size: 32px;border-bottom: 4px solid #3490dc;margin: 0 0 10px 0;">Lista de clientes</div>

            <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Dirección</th>
                  <th>Correo Electrónico</th>
                  <th>Teléfono</th>
                  <th>-</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $post)
                <tr>
                  <td>{{ $post->id }}</td>
                  <td>{{ $post->name }}</td>
                  <td>{{ $post->email }}</td>
                  <td>{{ $post->phone_number }}</td>
                  <td>
                    <a class="btn btn-success" href="/cliente/{{ $post->id }}">Editar</a>
                    <a class="btn btn-danger">Eliminar</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
        @endif\
    </div>
</div>
@endsection
