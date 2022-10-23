<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OvertimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "date" => $this->date,
            "time_started" => $this->time_started,
            "time_ended" => $this->time_ended,
            "overtime_duration" => $this->toHour($this->time_started, $this->time_ended),
        ];
    }

    public function toHour($timeStarted, $timeEnded) {
        $strTimeStarted = (int)strtr($timeStarted, 0, 2);
        $strTimeEnded = (int)strtr($timeEnded, 0, 2);

        return $strTimeEnded - $strTimeStarted;
    }

}
