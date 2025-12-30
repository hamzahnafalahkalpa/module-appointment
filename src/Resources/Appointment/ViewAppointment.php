<?php

namespace Hanafalah\ModuleAppointment\Resources\Appointment;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewAppointment extends ApiResource
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
        "id"             => $this->id,
        "name"           => $this->name,
        "reference_type" => $this->reference_type,
        "reference_id"   => $this->reference_id,
        'reference'      => $this->relationValidation('reference', function () {
            return $this->reference->toViewApi()->resolve();
        }, $this->prop_reference),
        "created_at"     => $this->created_at,
        "updated_at"     => $this->updated_at
    ];
    return $arr;
  }
}
