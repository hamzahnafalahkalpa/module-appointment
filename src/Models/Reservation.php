<?php

namespace Hanafalah\ModuleAppointment\Models;

use Hanafalah\ModuleAppointment\Resources\Reservation\{
    ViewReservation, ShowReservation
};

class Reservation extends Appointment
{
    protected $table = 'appointments';

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function getViewResource(){
        return ViewReservation::class;
    }

    public function getShowResource(){
        return ShowReservation::class;
    }
}
