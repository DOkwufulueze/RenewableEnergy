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
use Auth;

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
    $query = "SELECT SUM(TIMESTAMPDIFF(MINUTE, time_on, IFNULL(time_off, CURTIME()))) AS time_interval, DATE(time_on) AS time_on, device_id, energy_cost_per_hour FROM renewable_energy.device_usages INNER JOIN renewable_energy.devices ON (renewable_energy.devices.id = renewable_energy.device_usages.device_id) WHERE device_id IN (SELECT id FROM renewable_energy.devices WHERE user_id = '$id') GROUP BY DATE(time_on), device_id, energy_cost_per_hour;";
    $deviceUsages = DB::select($query);
    $dateArray = [];
    foreach ($deviceUsages as $deviceUsage) {
      $deviceId = $deviceUsage->device_id;
      $timeOn = $deviceUsage->time_on;
      $timeOnCarbon = Carbon::parse($timeOn);
      $timeIntervalInMinutes = $deviceUsage->time_interval;
      $energyPerHour = $deviceUsage->energy_cost_per_hour;
      $deviceName = Device::find($deviceId)->name;
      $deviceIdTimeArray = ["$deviceId" => []];
      $timeIntervalInHours = $timeIntervalInMinutes/60.0;
      $timeLeft = $timeIntervalInHours;
      $energyUsageHour = 0;
      $j = 1;
      array_push($deviceIdTimeArray["$deviceId"], ['name' => $deviceName]);
      for ($i = 1; $i <= ceil($timeIntervalInHours); $i++) {
        $timeLeft = $timeLeft < 1 ? (1 - $timeLeft) : $timeLeft;
        $energyUsageHour = $timeLeft < 1 ? $timeLeft : 1;
        $energyConsumed = $energyPerHour * $energyUsageHour;
        array_push($deviceIdTimeArray["$deviceId"], ["$j" => number_format($energyConsumed, 2) . ' J']);
        $timeLeft = $timeIntervalInHours - $i;
        if ($i % 24 == 0) {
          $j = 0;
          $userVectors["$timeOnCarbon"][] = $deviceIdTimeArray;
          $deviceIdTimeArray = ["$deviceId" => []];
          array_push($deviceIdTimeArray["$deviceId"], ['name' => $deviceName]);
          $timeOnCarbon->addDay();
        } else {
          if ($i == ceil($timeIntervalInHours)) {
            $userVectors["$timeOnCarbon"][] = $deviceIdTimeArray;
          }
        }
        $j += 1;
      }
    }

    return view('vectors.user', ['userVectors' => $userVectors, 'user' => $user]);
  }
}
