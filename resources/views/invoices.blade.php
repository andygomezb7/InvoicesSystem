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
                    <input type="text" name="name" class="form-control" id="username" value="{{ $info->name_invoice }}" placeholder="Nombre" required="">
                    <div class="invalid-feedback" style="width: 100%;">
                        El nombre del cliente es obligatorio.
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="nit">NIT</label>
                <div class="input-group">
                    <input type="text" name="nit" class="form-control" id="username" value="{{ $info->nit_invoice }}" placeholder="NIT" required="">
                    <div class="invalid-feedback" style="width: 100%;">
                        El NIT es obligatorio
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="address">Dirección</label>
                <div class="input-group">
                    <input type="text" name="address" class="form-control" id="username" value="{{ $info->address_invoice }}" placeholder="Dirección" required="">
                    <div class="invalid-feedback" style="width: 100%;">
                        La dirección es obligatoria
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="clientslist">Clientes</label>
                <select class="form-control" name="clientslist">
                    <option>Selecciona un cliente</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == $info->client_id ? 'selected' : '' }}>{{ $client->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona un cliente válido.
                </div>
            </div>

            <div class="mb-3">
                <label for="productslist">Productos</label>
                <select multiple class="form-control" name="productslist[]">
                    <option>Selecciona un producto</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ in_array($product->id, $info->productsAssigned->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Por favor, selecciona uno o más productos válidos.
                </div>
            </div>

            <div class="mb-3">
                <label for="paytype">Tipo de pago</label>
                <div class="input-group">
                    <select name="paytype" class="form-control">
                        <option>Selecciona un tipo de pago</option>
                        <option value="1" {{ $info->paytype == 1 ? 'selected' : '' }}>Contado</option>
                        <option value="2" {{ $info->paytype == 2 ? 'selected' : '' }}>Crédito</option>
                    </select>
                    <div class="invalid-feedback" style="width: 100%;">
                        El tipo de pago es obligatorio.
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
              <select multiple class="form-control" name="productslist[]">
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
                  <th>Numero</th>
                  <th>Nombre</th>
                  <th>NIT</th>
                  <th>Direccion</th>
                  <th>-</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $post)
                <tr>
                  <td>{{ $post->id }}</td>
                  <td>{{ $post->number }}</td>
                  <td>{{ $post->name_invoice }}</td>
                  <td>{{ $post->nit_invoice }}</td>
                  <td>{{ $post->address_invoice }}</td>
                  <td>
                    <a class="btn btn-success" href="/invoice/{{ $post->id }}">Editar</a>
                     <a href="{{ route('invoices.confirm-delete', ['id' => $post->id]) }}" class="btn btn-danger">Eliminar</a>
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
