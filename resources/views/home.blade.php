@extends('layouts.app')

@section('content')
<div class="container">
        <h1>Facturas</h1>

        <form action="{{ route('home') }}" method="GET">
            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" name="number" class="form-control" placeholder="Número de factura" value="{{ request('number') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="nit_invoice" class="form-control" placeholder="NIT" value="{{ request('nit_invoice') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Número de factura</th>
                    <th>Fecha</th>
                    <th>NIT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->number }}</td>
                        <td>{{ $invoice->create_date }}</td>
                        <td>{{ $invoice->nit_invoice }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
