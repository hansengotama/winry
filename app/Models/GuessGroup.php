<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuessGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];
}
