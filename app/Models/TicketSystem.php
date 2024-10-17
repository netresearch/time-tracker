<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'book_time',
        'url',
        'login',
        'password',
        'public_key',
        'private_key',
        'ticketurl',
        'oauth_consumer_key',
        'oauth_consumer_secret',
    ];
}
