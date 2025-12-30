<?php

namespace Hanafalah\ModuleAppointment\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleAppointment\Contracts\Data\QueueTransactionData as DataQueueTransactionData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class QueueTransactionData extends Data implements DataQueueTransactionData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('queue_number')]
    #[MapName('queue_number')]
    public ?string $queue_number = null;

    #[MapInputName('kiosk_id')]
    #[MapName('kiosk_id')]
    public mixed $kiosk_id = null;

    #[MapInputName('reference_id')]
    #[MapName('reference_id')]
    public mixed $reference_id = null;

    #[MapInputName('reference_type')]
    #[MapName('reference_type')]
    public ?string $reference_type = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;
}