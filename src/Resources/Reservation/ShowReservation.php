<?php

namespace Hanafalah\ModuleAppointment\Resources\Reservation;

use Hanafalah\ModuleAppointment\Resources\Appointment\ShowAppointment;

class ShowReservation extends ViewReservation
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray(\Illuminate\Http\Request $request): array
  {
    $arr = [];
    $show = $this->resolveNow(new ShowAppointment($this));
    $arr = $this->mergeArray(parent::toArray($request),$show,$arr);
    return $arr;
  }
}
