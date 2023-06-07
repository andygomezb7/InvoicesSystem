<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoices;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $invoices = Invoices::query();

        // Aplicar filtros
        if ($request->has('number')) {
            $invoices->where('number', 'LIKE', '%' . $request->number . '%');
        }

        if ($request->has('date')) {
            $invoices->whereDate('create_date', $request->date);
        }

        if ($request->has('nit_invoice')) {
            $invoices->where('nit_invoice', 'LIKE', '%' . $request->nit_invoice . '%');
        }

        // Obtener las facturas filtradas
        $filteredInvoices = $invoices->get();

        return view('home', ['invoices' => $filteredInvoices]);
    }
}
