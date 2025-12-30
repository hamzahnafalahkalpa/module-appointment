<?php

namespace Hanafalah\ModuleAppointment\Schemas;

use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleAppointment\{
    Supports\BaseModuleAppointment
};
use Hanafalah\ModuleAppointment\Contracts\Schemas\Appointment as ContractsAppointment;
use Hanafalah\ModuleAppointment\Contracts\Data\AppointmentData;
use Illuminate\Support\Str;

class Appointment extends BaseModuleAppointment implements ContractsAppointment
{
    protected string $__entity = 'Appointment';
    public $appointment_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'appointment',
            'tags'     => ['appointment', 'appointment-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreAppointment(AppointmentData $appointment_dto): Model{
        if (isset($appointment_dto->reference_type) && isset($appointment_dto->reference)){
            $reference_type   = $appointment_dto->reference_type;
            $reference_schema = config('module-appointment.reference_types.'.Str::snake($reference_type).'.schema');        
            if (isset($reference_schema) && isset($appointment_dto->reference)) {
                $schema_reference = $this->schemaContract(Str::studly($reference_schema));
                $reference        = $schema_reference->prepareStore($appointment_dto->reference);
                $appointment_dto->reference_id = $reference->getKey();
                $appointment_dto->props['prop_'.Str::snake($appointment_dto->reference_type)] = $reference->toViewApi()->resolve();
                $appointment_dto->name ??= $reference->name;
            }
        }

        $add = [
            'name' => $appointment_dto->name,
            'reference_type' => $appointment_dto->reference_type,
            'reference_id' => $appointment_dto->reference_id
        ];
        if (isset($appointment_dto->id)){
            $guard  = ['id' => $appointment_dto->id];
            $create = [$guard, $add];
        }else{
            $create = [$add];
        }

        $appointment = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($appointment,$appointment_dto->props);
        $appointment->save();
        return $this->appointment_model = $appointment;
    }
}