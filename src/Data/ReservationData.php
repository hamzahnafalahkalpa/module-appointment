<?php

namespace Hanafalah\ModuleAppointment\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleAppointment\Contracts\Data\ReservationData as DataReservationData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ReservationData extends AppointmentData implements DataReservationData
{
}