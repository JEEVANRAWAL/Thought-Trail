<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'content'
    ];

    protected $casts=[        // casts is responsible for how the value from the column will be read
        'content'=>'array'
    ];
}
