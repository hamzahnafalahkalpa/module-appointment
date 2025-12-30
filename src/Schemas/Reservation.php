<?php

namespace Hanafalah\ModuleAppointment\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleAppointment\{
    Supports\BaseModuleAppointment
};
use Hanafalah\ModuleAppointment\Contracts\Schemas\Reservation as ContractsReservation;
use Hanafalah\ModuleAppointment\Contracts\Data\ReservationData;

class Reservation extends Appointment implements ContractsReservation
{
    protected string $__entity = 'Reservation';
    public $reservation_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'reservation',
            'tags'     => ['reservation', 'reservation-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreReservation(ReservationData $reservation_dto): Model{
        $reservation = $this->prepareStoreAppointment($reservation_dto);
        $this->fillingProps($reservation,$reservation_dto->props);
        $reservation->save();
        return $this->reservation_model = $reservation;
    }
}