@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="row">
                <div class="display-4 float-left" style="font-size: 32px;border-bottom: 4px solid #3490dc;margin: 0 0 10px 0;">
                    @if ($info)
                        Editar Producto
                    @else
                        Crear Producto
                    @endif
                </div>
            </div>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="needs-validation" method="POST" action="{{url('products-form')}}" novalidate="">
                @csrf <!-- {{ csrf_field() }} -->
            @if ($info)
            <input type="hidden" name="id" value="{{ $info->id }}" />
            <div class="mb-3">
              <label for="username">Nombre</label>
              <div class="input-group">
                <input type="text" name="name" class="form-control" id="username" value="{{ $info->name }}" placeholder="Nombre" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El nombre del cliente es obligatorio.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="description">Descripción</label>
              <textarea name="description" class="form-control" id="email" placeholder="Descripción">{{ $info->description }}</textarea>
              <div class="invalid-feedback">
                La descripcion es obligatoria
              </div>
            </div>

            <div class="mb-3">
              <label for="price">Precio</label>
              <div class="input-group">
                <input type="text" name="price" value="{{ $info->price }}" class="form-control" id="price" placeholder="55.00" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El precio es obligatorio.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="price">Stock</label>
              <div class="input-group">
                <input type="text" name="stock" class="form-control" id="price" placeholder="55.00" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El precio es obligatorio.
                </div>
              </div>
            </div>
            @else
            <div class="mb-3">
              <label for="username">Nombre</label>
              <div class="input-group">
                <input type="text" name="name" class="form-control" id="username" placeholder="Nombre" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El nombre del cliente es obligatorio.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="description">Descripción</label>
              <textarea name="description" class="form-control" id="email" placeholder="Descripción"></textarea>
              <div class="invalid-feedback">
                La descripcion es obligatoria
              </div>
            </div>

            <div class="mb-3">
              <label for="price">Precio</label>
              <div class="input-group">
                <input type="text" name="price" class="form-control" id="price" placeholder="55.00" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El precio es obligatorio.
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="price">Stock</label>
              <div class="input-group">
                <input type="text" name="stock" class="form-control" id="price" placeholder="55.00" required="">
                <div class="invalid-feedback" style="width: 100%;">
                  El precio es obligatorio.
                </div>
              </div>
            </div>


            @endif

            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" type="submit">
                @if ($info)
                    Actualizar Producto
                @else
                    Crear Producto
                @endif
            </button>
          </form>
            
        </div>

        @if ($posts)
        <div class="col-md-12 mt-5 pt-5">

            <div class="display-4 float-left" style="font-size: 32px;border-bottom: 4px solid #3490dc;margin: 0 0 10px 0;">Lista de Productos</div>

            <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Precio</th>
                  <th>Stock</th>
                  <th>-</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $post)
                <tr>
                  <td>{{ $post->id }}</td>
                  <td>{{ $post->name }}</td>
                  <td>{{ $post->description }}</td>
                  <td>{{ $post->price }}</td>
                  <td>{{ $post->stock }}</td>
                  <td>
                    <a class="btn btn-success" href="/producto/{{ $post->id }}">Editar</a>
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
