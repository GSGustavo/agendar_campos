<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campos extends Model
{
    protected $table = 'campos';
    protected $fillable = [
        'id',
        'nome',
        'maps_link',
        'status',
        'created_at',
        'updated_at'
    ];
}
