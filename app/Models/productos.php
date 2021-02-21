<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;
    
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $filiable = [
        'name',
        'code',
        'stock',
        'description',
        'price_cost',
        'price_sell'
    ];
}
