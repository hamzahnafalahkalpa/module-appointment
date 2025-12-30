<?php

namespace Hanafalah\ModuleAppointment\Contracts\Schemas;

use Hanafalah\ModuleAppointment\Contracts\Data\AppointmentData;
//use Hanafalah\ModuleAppointment\Contracts\Data\AppointmentUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleAppointment\Schemas\Appointment
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateAppointment(?AppointmentData $appointment_dto = null)
 * @method Model prepareUpdateAppointment(AppointmentData $appointment_dto)
 * @method bool deleteAppointment()
 * @method bool prepareDeleteAppointment(? array $attributes = null)
 * @method mixed getAppointment()
 * @method ?Model prepareShowAppointment(?Model $model = null, ?array $attributes = null)
 * @method array showAppointment(?Model $model = null)
 * @method Collection prepareViewAppointmentList()
 * @method array viewAppointmentList()
 * @method LengthAwarePaginator prepareViewAppointmentPaginate(PaginateData $paginate_dto)
 * @method array viewAppointmentPaginate(?PaginateData $paginate_dto = null)
 * @method array storeAppointment(?AppointmentData $appointment_dto = null)
 * @method Collection prepareStoreMultipleAppointment(array $datas)
 * @method array storeMultipleAppointment(array $datas)
 */

interface Appointment extends DataManagement
{
    public function prepareStoreAppointment(AppointmentData $appointment_dto): Model;
}