<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'jira_id',
        'jira_ticket',
        'ticket_system',
        'active',
        'global',
        'estimation',
        'offer',
        'billing',
        'cost_center',
        'internal_ref',
        'external_ref',
        'project_lead_id',
        'technical_lead_id',
        'invoice',
        'additional_information_from_external',
        'internal_jira_project_key',
        'internal_jira_ticket_system',
        'subtickets',
    ];
}
