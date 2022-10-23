<?php

namespace App\Http\Resources;

use App\Models\Overtime;
use Illuminate\Http\Resources\Json\JsonResource;

class OvertimePayResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'salary' => $this->salary,
            'overtimes' => OvertimeResource::collection(
                Overtime::where('employee_id', $this->id)
                    ->where('date', 'LIKE', '%' . $request->month . '%')
                    ->get()
            ),
            'overtime_duration_total' => $this->toTotalDuration(
                Overtime::where('employee_id', $this->id)
                    ->where('date', 'LIKE', '%' . $request->month . '%')
                    ->get()
            ),
            'amount' => floor(
                $this->amountUpahMethod1(
                    $this->salary,
                    $this->toTotalDuration(
                        Overtime::where('employee_id', $this->id)
                            ->where('date', 'LIKE', '%' . $request->month . '%')
                            ->get()
                    )
                )
            ),
        ];
    }

    public function toHour($timeStarted, $timeEnded)
    {
        $strTimeStarted = (int) strtr($timeStarted, 0, 2);
        $strTimeEnded = (int) strtr($timeEnded, 0, 2);

        return $strTimeEnded - $strTimeStarted;
    }

    public function toTotalDuration($overtimes)
    {
        $totalDuration = 0;
        for ($i = 0; $i < sizeof($overtimes); $i++) {
            $totalDuration =
                $totalDuration +
                $this->toHour(
                    $overtimes[$i]['time_started'],
                    $overtimes[$i]['time_ended']
                );
        }
        return $totalDuration;
    }

    public function amountUpahMethod1($salary, $totalDuration)
    {
        return ($salary / 173) * $totalDuration;
    }

    public function amountUpahMethod2($totalDuration)
    {
        return 10000 * $totalDuration;
    }
}
