<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamentos extends Model
{
    protected $table = 'agendamentos';
    protected $fillable = [
        // 'id', 'user_id', 'campo_id', 'date', 'init_time', 'end_time', 'status', 'updated_at', 'created_at'
        'id', 'user_id', 'campo_id', 'start_on', 'end_on', 'status', 'updated_at', 'created_at'
    ] ;

       /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'end_on'  => 'datetime:d/m/Y H:i:s',
            // 'start_on'  => 'datetime:d/m/Y H:i:s',
            'created_at' => 'datetime:d/m/Y H:i:s',
            'updated_at' => 'datetime:d/m/Y H:i:s'
        ];
    }
}
