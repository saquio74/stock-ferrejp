<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ventas extends Model
{
    use HasFactory;
    protected $table = 'ventas';
    protected $id = 'id';
    protected $filiable = [
        'id',
        'amount',
        'product_id',
        'units',
        'price_cost'
    ];
}
