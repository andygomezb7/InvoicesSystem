@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="row">
                <div class="display-4 float-left" style="font-size: 32px;border-bottom: 4px solid #3490dc;margin: 0 0 10px 0;">
                    @if ($info)
                        Editar Factura
                    @else
                        Crear Factura
                    @endif
                </div>
            </div>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="needs-validation" method="POST" action="{{url('invoices-form')}}" novalidate="">
                @csrf <!-- {{ csrf_field() }} -->
            @if ($info)
            <input type="hidden" name="id" value="{{ $info->id }}" />
            <div class="mb-3">
              <label for="name">Nombre</label>
              <div class="input-group">
                <input type="text" name="name" class="form-control" id="username" value="{{ $info->name }}" placeholder="Nombre" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El nombre del cliente es obligatorio.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="nit">NIT</label>
              <div class="input-group">
                <input type="text" name="nit" class="form-control" id="username" value="{{ $info->name }}" placeholder="NIT" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El NIT es obligatorio
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="address">Dirección</label>
              <div class="input-group">
                <input type="text" name="address" class="form-control" id="username" value="{{ $info->name }}" placeholder="Dirección" required="">
                <div class="invalid-feedback" style="width: 100%;">
                 La dirección es obligatoria
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="clientslist">Clientes</label>
              <select  class="form-control" name="clientslist">
                <option>Selecciona un producto</option>
                @foreach($clients as $post)
                  <option value="{{ $post->id }}">{{ $post->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="productslist">Productos</label>
              <select multiple class="form-control" name="productslist">
                <option>Selecciona un producto</option>
                @foreach($products as $post)
                  <option value="{{ $post->id }}">{{ $post->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="paytype">Tipo de pago</label>
              <div class="input-group">
                <select name="paytype" class="form-control">
                  <option>Selecciona un tipo de pago</option>
                  <option value="1">Contado</option>
                  <option value="1">Crédito</option>
                </select>
                <div class="invalid-feedback" style="width: 100%;">
                  El numero de telefono es obligatorio.
                </div>
              </div>
            </div>
            @else
            <div class="mb-3">
              <label for="name">Nombre</label>
              <div class="input-group">
                <input type="text" name="name" class="form-control" id="username"  placeholder="Nombre" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El nombre del cliente es obligatorio.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="nit">NIT</label>
              <div class="input-group">
                <input type="text" name="nit" class="form-control" id="username" placeholder="NIT" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El NIT es obligatorio
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="address">Dirección</label>
              <div class="input-group">
                <input type="text" name="address" class="form-control" id="username" placeholder="Dirección" required="">
                <div class="invalid-feedback" style="width: 100%;">
                 La dirección es obligatoria
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="clientslist">Clientes</label>
              <select class="form-control" name="clientslist">
                <option>Selecciona un cliente</option>
                @foreach($clients as $post)
                  <option value="{{ $post->id }}">{{ $post->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="productslist">Productos</label>
              <select multiple class="form-control" name="productslist">
                <option>Selecciona un producto</option>
                @foreach($products as $post)
                  <option value="{{ $post->id }}">{{ $post->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="paytype">Tipo de pago</label>
              <div class="input-group">
                <select name="paytype" class="form-control">
                  <option>Selecciona un tipo de pago</option>
                  <option value="1">Contado</option>
                  <option value="1">Crédito</option>
                </select>
                <div class="invalid-feedback" style="width: 100%;">
                  El numero de telefono es obligatorio.
                </div>
              </div>
            </div>
            @endif

            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" type="submit">
                @if ($info)
                    Actualizar factura
                @else
                    Crear factura
                @endif
            </button>
          </form>
            
        </div>

        @if ($posts)
        <div class="col-md-12 mt-5 pt-5">

            <div class="display-4 float-left" style="font-size: 32px;border-bottom: 4px solid #3490dc;margin: 0 0 10px 0;">Lista de facturas</div>

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
                    <a class="btn btn-success" href="/invoice/{{ $post->id }}">Editar</a>
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
