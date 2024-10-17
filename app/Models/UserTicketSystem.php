<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTicketSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_system_id',
        'accesstoken',
        'tokensecret',
        'avoidconnection',
    ];
}
