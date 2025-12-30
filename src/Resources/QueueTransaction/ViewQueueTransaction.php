<?php

namespace Hanafalah\ModuleAppointment\Resources\QueueTransaction;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewQueueTransaction extends ApiResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [
      'id'          => $this->id,
      'queue_number'=> $this->queue_number,
      'kiosk_id'    => $this->kiosk_id,
      'kiosk'       => $this->relationValidation('kiosk', function () {
          return $this->kiosk->toViewApi()->resolve();
      }, $this->prop_kiosk),
      'created_at'  => $this->created_at,
      'updated_at'  => $this->updated_at
    ];
    return $arr;
  }
}
