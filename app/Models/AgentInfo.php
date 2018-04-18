<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentInfo extends Model
{
    protected $table = 'agent_info';


    protected $primaryKey = 'agentId';

    protected $fillable = array(
        'agentId',
        'agentName',
        'agentType',
        'agentGrade',
        'province',
        'city',
        'area',
        'belongsIndustry',
        'authorization'
    );
}
