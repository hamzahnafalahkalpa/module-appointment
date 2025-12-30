<?php

namespace Hanafalah\ModuleAppointment\Models;

use Hanafalah\ModuleItem\Models\InventoryItem;

class Kiosk extends InventoryItem
{
    protected $table = 'inventory_items';

    public function queueTransaction(){return $this->hasOneModel('QueueTransaction','kiosk_id');}
    public function queueTransactions(){return $this->hasManyModel('QueueTransaction','kiosk_id');}
}
