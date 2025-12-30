<?php

namespace Hanafalah\ModuleAppointment\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\ModuleAppointment\Resources\QueueTransaction\{
    ViewQueueTransaction,
    ShowQueueTransaction
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class QueueTransaction extends BaseModel
{
    use HasUlids, HasProps, SoftDeletes;
    
    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    public $list = [
        'id',
        'queue_number',
        'kiosk_id',
        'reference_type',
        'reference_id',
        'props',
    ];

    protected $casts = [
        'queue_number' => 'string',
        'kiosk_id' => 'string',
        'reference_type' => 'string',
        'reference_id' => 'string',
    ];

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function getViewResource(){
        return ViewQueueTransaction::class;
    }

    public function getShowResource(){
        return ShowQueueTransaction::class;
    }

    public function reference(){return $this->morphTo();}
    public function kiosk(){return $this->belongsToModel('Kiosk');}
}
