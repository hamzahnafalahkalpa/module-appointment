<?php

namespace Hanafalah\ModuleAppointment\Data;

use Hanafalah\ModuleAppointment\Contracts\Data\KioskData as DataKioskData;
use Hanafalah\ModuleItem\Data\InventoryItemData;

class KioskData extends InventoryItemData implements DataKioskData
{
    public static function before(array &$attributes){
        $attributes['flag'] ??= 'Kiosk';
        parent::before($attributes);
    }
}