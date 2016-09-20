<?php

namespace RenewableEnergy\Http\Controllers;

use Illuminate\Http\Request;

use RenewableEnergy\Http\Requests;
use RenewableEnergy\User;
use RenewableEnergy\DeviceType;
use RenewableEnergy\Device;
use RenewableEnergy\DeviceUsage;
use Carbon\Carbon;
use DB;

class VectorsController extends Controller
{
  //
  function index() {
    //
    return view('vectors.index', ['users' => User::all(),'cb'=>Carbon::today(),'nw'=>Carbon::now() ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function user($id) {
    //
    $userVectors = [];
    $today = Carbon::today();
    $now = Carbon::now();
    $user = User::find($id);
    $devices = Device::where('user_id', $id)->get();
    $deviceId = 25;
    $query = "SELECT SUM(TIMESTAMPDIFF(MINUTE, time_on, IFNULL(time_off, CURTIME()))) AS time_interval, DATE(time_on) AS time_on, device_id, energy_cost_per_hour FROM renewable_energy.device_usages INNER JOIN renewable_energy.devices ON (renewable_energy.devices.id = renewable_energy.device_usages.device_id) WHERE device_id IN (SELECT id FROM renewable_energy.devices WHERE user_id = '$id') GROUP BY DATE(time_on), device_id;";
    $deviceUsages = DB::select($query);
    $dateArray = [];
    foreach ($deviceUsages as $deviceUsage) {
      $deviceId = $deviceUsage->device_id;
      $timeOn = $deviceUsage->time_on;
      $timeIntervalInMinutes = $deviceUsage->time_interval;
      $energyPerHour = $deviceUsage->energy_cost_per_hour;
      $deviceIdTimeArray = ["$deviceId" => []];
      $timeIntervalInHours = $timeIntervalInMinutes/60.0;
      $timeLeft = $timeIntervalInHours;
      $energyUsageHour = 0;
      for ($i = 0; $i < $timeIntervalInHours; $i++) {
        $timeLeft = $timeLeft < 1 ? (1 - $timeLeft) : $timeLeft;
        $energyUsageHour = $timeLeft < 1 ? $timeLeft : 1;
        $energyConsumed = $energyPerHour * $energyUsageHour;
        array_push($deviceIdTimeArray["$deviceId"], ["$i" => number_format($energyConsumed, 2)]);
        $timeLeft = $timeIntervalInHours - ($i + 1);
      }

      $userVectors["$timeOn"][] = $deviceIdTimeArray;
    }

    return view('vectors.user', ['userVectors' => $userVectors, 'user' => $user]);
  }
}
