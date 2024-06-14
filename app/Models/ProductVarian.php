<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVarian extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_size_id',
        'product_color_id',
        'quatity',
        'image',
    ];
}
