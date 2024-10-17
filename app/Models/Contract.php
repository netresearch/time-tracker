<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start',
        'end',
        'hours_0',
        'hours_1',
        'hours_2',
        'hours_3',
        'hours_4',
        'hours_5',
        'hours_6',
    ];
}
