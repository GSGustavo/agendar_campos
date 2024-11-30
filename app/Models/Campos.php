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
        'updated_at',
        'status'
    ];

     /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
       
            'created_at' => 'datetime:d/m/Y H:i:s',
            'updated_at' => 'datetime:d/m/Y H:i:s'
        ];
    }
}
