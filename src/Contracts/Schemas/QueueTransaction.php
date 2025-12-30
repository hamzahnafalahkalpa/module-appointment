<?php

namespace Hanafalah\ModuleAppointment\Contracts\Schemas;

use Hanafalah\ModuleAppointment\Contracts\Data\QueueTransactionData;
//use Hanafalah\ModuleAppointment\Contracts\Data\QueueTransactionUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleAppointment\Schemas\QueueTransaction
 * @method mixed export(string $type)
 * @method self conditionals(mixed $conditionals)
 * @method array updateQueueTransaction(?QueueTransactionData $queue_transaction_dto = null)
 * @method Model prepareUpdateQueueTransaction(QueueTransactionData $queue_transaction_dto)
 * @method bool deleteQueueTransaction()
 * @method bool prepareDeleteQueueTransaction(? array $attributes = null)
 * @method mixed getQueueTransaction()
 * @method ?Model prepareShowQueueTransaction(?Model $model = null, ?array $attributes = null)
 * @method array showQueueTransaction(?Model $model = null)
 * @method Collection prepareViewQueueTransactionList()
 * @method array viewQueueTransactionList()
 * @method LengthAwarePaginator prepareViewQueueTransactionPaginate(PaginateData $paginate_dto)
 * @method array viewQueueTransactionPaginate(?PaginateData $paginate_dto = null)
 * @method array storeQueueTransaction(?QueueTransactionData $queue_transaction_dto = null)
 * @method Collection prepareStoreMultipleQueueTransaction(array $datas)
 * @method array storeMultipleQueueTransaction(array $datas)
 */

interface QueueTransaction extends DataManagement
{
    public function prepareStoreQueueTransaction(QueueTransactionData $queue_transaction_dto): Model;
}