<?php

namespace Hanafalah\ModuleAppointment\Contracts\Schemas;

use Hanafalah\ModuleAppointment\Contracts\Data\KioskData;
//use Hanafalah\ModuleAppointment\Contracts\Data\KioskUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleItem\Contracts\Schemas\InventoryItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleAppointment\Schemas\Kiosk
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateKiosk(?KioskData $kiosk_dto = null)
 * @method Model prepareUpdateKiosk(KioskData $kiosk_dto)
 * @method bool deleteKiosk()
 * @method bool prepareDeleteKiosk(? array $attributes = null)
 * @method mixed getKiosk()
 * @method ?Model prepareShowKiosk(?Model $model = null, ?array $attributes = null)
 * @method array showKiosk(?Model $model = null)
 * @method Collection prepareViewKioskList()
 * @method array viewKioskList()
 * @method LengthAwarePaginator prepareViewKioskPaginate(PaginateData $paginate_dto)
 * @method array viewKioskPaginate(?PaginateData $paginate_dto = null)
 * @method array storeKiosk(?KioskData $kiosk_dto = null)
 * @method Collection prepareStoreMultipleKiosk(array $datas)
 * @method array storeMultipleKiosk(array $datas)
 */

interface Kiosk extends InventoryItem
{
    public function prepareStoreKiosk(KioskData $kiosk_dto): Model;
}