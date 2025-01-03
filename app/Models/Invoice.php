<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $fillable = ['customer_id', 'total_amount', 'discount', 'advance', 'status', 'type'];


    public function party()
    {
        return $this->belongsTo(Party::class, 'customer_id');
    }

    public function invoice_products()
    {
        return $this->hasMany(InvoiceProduct::class);
    }
}
