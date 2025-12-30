<?php

namespace Hanafalah\ModuleAppointment\Contracts\Schemas;

use Hanafalah\ModuleAppointment\Contracts\Data\ReservationData;
//use Hanafalah\ModuleAppointment\Contracts\Data\ReservationUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleAppointment\Schemas\Reservation
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateReservation(?ReservationData $reservation_dto = null)
 * @method Model prepareUpdateReservation(ReservationData $reservation_dto)
 * @method bool deleteReservation()
 * @method bool prepareDeleteReservation(? array $attributes = null)
 * @method mixed getReservation()
 * @method ?Model prepareShowReservation(?Model $model = null, ?array $attributes = null)
 * @method array showReservation(?Model $model = null)
 * @method Collection prepareViewReservationList()
 * @method array viewReservationList()
 * @method LengthAwarePaginator prepareViewReservationPaginate(PaginateData $paginate_dto)
 * @method array viewReservationPaginate(?PaginateData $paginate_dto = null)
 * @method array storeReservation(?ReservationData $reservation_dto = null)
 * @method Collection prepareStoreMultipleReservation(array $datas)
 * @method array storeMultipleReservation(array $datas)
 */

interface Reservation extends Appointment
{
    public function prepareStoreReservation(ReservationData $reservation_dto): Model;
}