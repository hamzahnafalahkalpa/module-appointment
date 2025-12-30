<?php

namespace Hanafalah\ModuleAppointment\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleAppointment\Contracts\Data\AppointmentData as DataAppointmentData;
use Hanafalah\ModuleAppointment\Contracts\Data\QueueTransactionData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class AppointmentData extends Data implements DataAppointmentData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('name')]
    #[MapName('name')]
    public ?string $name = null;

    #[MapInputName('reference_type')]
    #[MapName('reference_type')]
    public ?string $reference_type = null;

    #[MapInputName('reference_id')]
    #[MapName('reference_id')]
    public mixed $reference_id = null;

    #[MapInputName('reference')]
    #[MapName('reference')]
    public ?array $reference = null;

    #[MapInputName('queue_transaction')]
    #[MapName('queue_transaction')]
    public ?QueueTransactionData $queue_transaction = null;

    #[MapInputName('props')]
    #[MapName('props')]
    public ?array $props = null;
}