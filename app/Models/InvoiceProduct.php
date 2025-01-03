<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    //
    protected $fillable = ['product_id', 'qty', 'invoice_id', 'plai_id', 'width_in_feet', 'width_in_inches', 'height_in_feet', 'height_in_inches', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function plai()
    {
        return $this->belongsTo(Plai::class);
    }
}
