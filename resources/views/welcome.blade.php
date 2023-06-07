@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Inicio</div>

                    <div class="card-body">
                        <div class="text-center">
                            <img src="/path/to/image1.jpg" alt="Imagen 1" class="img-fluid">
                        </div>

                        <h1 class="text-center mt-4">Bienvenido a la aplicación de facturación</h1>

                        <p class="text-center">Aquí puedes crear tus facturas, agregar productos y gestionar tus clientes de manera sencilla.</p>

                        <h2 class="text-center mt-4">Resumen de la aplicación</h2>
                        <ul>
                            <li>Crea tus propias facturas personalizadas con un número único.</li>
                            <li>Agrega y administra tus productos y servicios para incluirlos en las facturas.</li>
                            <li>Registra y gestiona la información de tus clientes para una fácil asignación a las facturas.</li>
                        </ul>

                        <h2 class="text-center mt-4">Menú de opciones</h2>
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Tablero</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('clients') }}">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('products') }}">Productos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('invoices') }}">Facturas</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('register') }}">Registro</a>
                                </li>
                            @endif
                        </ul>

                        <div class="text-center mt-4">
                            <img src="/path/to/image2.jpg" alt="Imagen 2" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection