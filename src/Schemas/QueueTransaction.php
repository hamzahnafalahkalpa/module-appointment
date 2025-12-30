<?php

namespace Hanafalah\ModuleAppointment\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleAppointment\{
    Supports\BaseModuleAppointment
};
use Hanafalah\ModuleAppointment\Contracts\Schemas\QueueTransaction as ContractsQueueTransaction;
use Hanafalah\ModuleAppointment\Contracts\Data\QueueTransactionData;

class QueueTransaction extends BaseModuleAppointment implements ContractsQueueTransaction
{
    protected string $__entity = 'QueueTransaction';
    public $queue_transaction_model;
    //protected mixed $__order_by_created_at = false; //asc, desc, false

    protected array $__cache = [
        'index' => [
            'name'     => 'queue_transaction',
            'tags'     => ['queue_transaction', 'queue_transaction-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreQueueTransaction(QueueTransactionData $queue_transaction_dto): Model{
        $add = [
            'name' => $queue_transaction_dto->name
        ];
        $guard  = ['id' => $queue_transaction_dto->id];
        $create = [$guard, $add];
        // if (isset($queue_transaction_dto->id)){
        //     $guard  = ['id' => $queue_transaction_dto->id];
        //     $create = [$guard, $add];
        // }else{
        //     $create = [$add];
        // }

        $queue_transaction = $this->usingEntity()->updateOrCreate(...$create);
        $this->fillingProps($queue_transaction,$queue_transaction_dto->props);
        $queue_transaction->save();
        return $this->queue_transaction_model = $queue_transaction;
    }
}