<?php

namespace Hanafalah\ModuleAppointment\Schemas;

use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleAppointment\Contracts\Schemas\Kiosk as ContractsKiosk;
use Hanafalah\ModuleAppointment\Contracts\Data\KioskData;
use Hanafalah\ModuleItem\Models\InventoryItem;

class Kiosk extends InventoryItem implements ContractsKiosk
{
    protected string $__entity = 'Kiosk';
    public $kiosk_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'kiosk',
            'tags'     => ['kiosk', 'kiosk-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreKiosk(KioskData $kiosk_dto): Model{
        $add = [
            'name' => $kiosk_dto->name
        ];
        $guard  = ['id' => $kiosk_dto->id];
        $create = [$guard, $add];
        // if (isset($kiosk_dto->id)){
        //     $guard  = ['id' => $kiosk_dto->id];
        //     $create = [$guard, $add];
        // }else{
        //     $create = [$add];
        // }

        $kiosk = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($kiosk,$kiosk_dto->props);
        $kiosk->save();
        return $this->kiosk_model = $kiosk;
    }
}