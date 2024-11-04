<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamentos extends Model
{
    protected $table = 'agendamentos';
    protected $fillable = [
        'id', 'user_id', 'campo_id', 'date', 'init_time', 'end_time', 'status', 'updated_at', 'created_at'
    ] ;
}
