<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'start',
        'end',
        'customer_id',
        'project_id',
        'account_id',
        'activity_id',
        'ticket',
        'worklog_id',
        'description',
        'duration',
        'user_id',
        'class',
        'synced_to_ticketsystem',
        'internal_jira_ticket_original_key',
    ];
}
