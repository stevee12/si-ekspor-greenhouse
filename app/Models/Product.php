<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'jenis', 'code', 'name', 'price', 'stock'
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
