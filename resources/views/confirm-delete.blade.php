@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Confirmar eliminación de factura</div>

                    <div class="card-body">
                        <p>¿Estás seguro de que deseas eliminar la factura con el número {{ $invoice->number }}?</p>

                        <form action="{{ route('invoices.delete', ['id' => $invoice->id]) }}" method="get">
                            @csrf
                            <button type="submit" name="confirm" class="btn btn-danger">Confirmar</button>
                            <a href="{{ url('invoices') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection