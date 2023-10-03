<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;

    protected $fillable = [
        "SKU",
        "name",
        "category",
        "description",
        "price",
        "image",
        'author',
        'users_id'
    ];
}
