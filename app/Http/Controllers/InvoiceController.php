<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoices;
use App\Clients;
use App\Products;
use App\ProductAssigned;

class InvoiceController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param null
     * @return View
     */
    public function show()
    {
        $invoices = Invoices::all();
        $clients = Clients::all();
        $products = Products::all();

        return view('invoices', ['info' => null, 'invoices' => $invoices, 'products' => $products, 'clients' => $clients, 'posts' => $invoices]);
    }

    public function edit(Request $request, $id = '')
    {
        $info = \App\Invoices::with('productsAssigned')->findOrFail($id);
        $clients = Clients::all();
        $products = Products::all();

        return view('invoices', ['info' => $info, 'posts' => [], 'products' => $products, 'clients' => $clients]);
    }

    public function store(Request $request)
    {
        if ($request->id) {
            $invoice = Invoices::find($request->id);
            $invoice->name_invoice = $request->name;
            $invoice->nit_invoice = $request->nit;
            $invoice->address_invoice = $request->address;
            $invoice->client_id = $request->clientslist;
            $invoice->save();

            // Eliminar las asignaciones de productos existentes para esta factura
            ProductAssigned::where('id_invoice', $invoice->id)->delete();

            $productsAssigned = $request->input('productslist', []);
            foreach ($productsAssigned as $productId) {
                $productAssigned = new ProductAssigned;
                $productAssigned->id_producto = $productId;
                $productAssigned->id_invoice = $invoice->id;
                $productAssigned->save();
            }

            // Genera el número de factura
            $invoiceNumber = $this->generateInvoiceNumber($invoice->id);
            $invoice->number = $invoiceNumber;
            $invoice->save();

            return redirect('invoices')->with('status', 'Factura actualizada exitosamente');
        } else {
            $invoice = new Invoices;
            $invoice->name_invoice = $request->name;
            $invoice->nit_invoice = $request->nit;
            $invoice->address_invoice = $request->address;
            $invoice->client_id = $request->clientslist;
            $invoice->create_date = now();
            $invoice->save();

            $productsAssigned = $request->input('productslist', []);
            if (is_array($productsAssigned)) {
                foreach ($productsAssigned as $productId) {
                    $productAssigned = new ProductAssigned;
                    $productAssigned->id_producto = $productId;
                    $productAssigned->id_invoice = $invoice->id;
                    $productAssigned->save();
                }
            }

            // Genera el número de factura
            $invoiceNumber = $this->generateInvoiceNumber($invoice->id);
            $invoice->number = $invoiceNumber;
            $invoice->save();

            return redirect('invoices')->with('status', 'Nueva factura creada exitosamente');
        }
    }

    public function delete($id)
    {
        $invoice = Invoices::findOrFail($id);
        $invoice->delete();

        // Eliminar las asignaciones de productos para esta factura
        ProductAssigned::where('id_invoice', $id)->delete();

        return redirect('invoices')->with('status', 'Factura eliminada exitosamente');
    }

    public function confirmDelete(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            if ($request->confirm) {
                $invoice = Invoices::findOrFail($id);
                $invoice->delete();

                // Eliminar las asignaciones de productos para esta factura
                ProductAssigned::where('id_invoice', $id)->delete();

                return redirect('invoices')->with('status', 'Factura eliminada exitosamente');
            } else {
                return redirect('invoices')->with('status', 'Eliminación de factura cancelada');
            }
        } else {
            $invoice = Invoices::findOrFail($id);
            return view('confirm-delete', ['invoice' => $invoice]);
        }
    }

    public function generateInvoiceNumber($id)
    {
        // Agrega el prefijo deseado para el número de factura (opcional)
        $prefix = 'INV-';

        // Obtiene el año actual para incluirlo en el número de factura
        $year = date('Y');

        // Genera el número de factura concatenando el prefijo, el año y el ID de inserción
        $invoiceNumber = $prefix . $year . '-' . str_pad($id, 5, '0', STR_PAD_LEFT);

        return $invoiceNumber;
    }
}