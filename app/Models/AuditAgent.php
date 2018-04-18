<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditAgent extends Model
{

    //                              orm

    protected $table = 'agent_audit';

    protected $fillable = [
        'type', 'is_latch', 'commitDate', 'agentName', 'agentId', 'region', 'agencyName', 'agencyId',
        'propertyName', 'propertyId', 'place', 'longitude', 'is_completed', 'latitude', 'phone', 'remark',
        'describe', 'attachmentFileId', 'attachmentName', 'auditStatus', 'commission', 'remoteId', 'disabledTime', 'created_at', 'updated_at',
    ];

    public $timestamps = false;
}
