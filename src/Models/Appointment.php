<?php

namespace Hanafalah\ModuleAppointment\Models;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\ModuleAppointment\Resources\Appointment\{
    ViewAppointment,
    ShowAppointment
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Appointment extends BaseModel
{
    use HasUlids, HasProps, SoftDeletes;
    
    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';
    public $list = [
        'id',
        'name',
        'reference_type',
        'reference_id',
        'props',
    ];

    protected $casts = [
        'name' => 'string',
        'reference_type' => 'string',
        'reference_id' => 'string'
    ];

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [
            'reference','kiosk'
        ];
    }

    public function getViewResource(){
        return ViewAppointment::class;
    }

    public function getShowResource(){
        return ShowAppointment::class;
    }

    public function reference(){return $this->morphTo();}
    public function queueTransaction(){return $this->morphOneModel('QueueTransaction','reference');}
}
