<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    //
    protected $table = 'invoices';
    /**
     * Obtener los productos asignados a la factura.
     */
    public function productsAssigned()
    {
        return $this->hasMany(productAssigned::class, 'id_invoice');
    }
}
