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
use RenewableEnergy\Admin\LocationDistributor;
use RenewableEnergy\Admin\Location;
use RenewableEnergy\Admin\Distributor;

class VectorsController extends Controller
{
  //
  function index() {
    //
    $energyDistributorsArray = array();
    $energyDistributors = LocationDistributor::all();
    foreach ($energyDistributors as $energyDistributor) {
      array_push($energyDistributorsArray, array(
        'id' => $energyDistributor->id,
        'name' => Distributor::find($energyDistributor->distributor_id)->name . '/' . Location::find($energyDistributor->location_id)->name
      ));
    }

    return view('vectors.index', ['users' => User::all(), 'energyDistributors' => $energyDistributorsArray ]);
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

  public function energyDistributor($id) {
    //
    $energyCostsArray = array();
    $energyDistributorVectors = array();
    $usersArray = array();
    $users = User::where('location_distributor_id', $id)->get();
    $locationDistributor = LocationDistributor::find($id);
    $energyDistributor = Distributor::find($locationDistributor->distributor_id)->name . '/' . Location::find($locationDistributor->location_id)->name;
    $carriedOverEnergy = 0;
    $colorCodes = ['#ee3333', '#33ee33', '#eeee33'];
    $colors = ['#ffffff', 'inherit', 'inherit'];

    for ($i = 0; $i < 24; $i++) {
      $totalEnergyUsed = 0;
      $totalShiftableEnergy = 0;
      $totalUnshiftableEnergy = 0;
      $unsuppliedEnergy = 0;
      $scheduledEnergyForSupply = json_decode($locationDistributor->scheduled_energy_per_hour)[$i];
      $usersArray[$i] = [];
      foreach ($users as $user) {
        $shiftableEnergy = DB::select("SELECT SUM(energy_cost_per_hour) AS energy_cost, device_type_id FROM renewable_energy.devices WHERE user_id = '$user->id' AND device_type_id = '1' GROUP BY device_type_id");
        $unshiftableEnergy = DB::select("SELECT SUM(energy_cost_per_hour) AS energy_cost, device_type_id FROM renewable_energy.devices WHERE user_id = '$user->id' AND device_type_id = '2' GROUP BY device_type_id");
        // var_dump($shiftableEnergy[0]->energy_cost);die;
        $totalShiftableEnergy += $shiftableEnergy ? $shiftableEnergy[0]->energy_cost : 0;
        $totalUnshiftableEnergy += $unshiftableEnergy ? $unshiftableEnergy[0]->energy_cost : 0;
        array_push($usersArray[$i], array(
          'id' => $user->id,
          'name' => $user->name,
          'shiftableEnergy' => $shiftableEnergy ? $shiftableEnergy[0]->energy_cost : 0,
          'unshiftableEnergy' => $unshiftableEnergy ? $unshiftableEnergy[0]->energy_cost : 0
        ));
      }
      array_push($energyCostsArray, array(
        'hour' => $i,
        'scheduledEnergyForSupply' => $scheduledEnergyForSupply,
        'usersArray' => $usersArray
      ));
      // var_dump($usersArray);die;

      $totalEnergyRequirement = $totalShiftableEnergy + $totalUnshiftableEnergy;
      $totalShiftableAndCarriedOverEnergy = $totalShiftableEnergy + $carriedOverEnergy;
      if ($totalUnshiftableEnergy > $scheduledEnergyForSupply) {
        $remark = 'Insufficent Energy Supply';
        $status = 0;
      } else {
        if (($totalShiftableAndCarriedOverEnergy + $totalUnshiftableEnergy) <= $scheduledEnergyForSupply) {
          $totalEnergyUsed = $totalShiftableAndCarriedOverEnergy + $totalUnshiftableEnergy;
          $carriedOverEnergy = 0;
          $remark = 'Energy Requirement within Supply Range';
          $status = 1;
        } else if (($totalShiftableAndCarriedOverEnergy + $totalUnshiftableEnergy) > $scheduledEnergyForSupply) {
          $totalEnergyUsed = $scheduledEnergyForSupply;
          $carriedOverEnergy += $totalShiftableAndCarriedOverEnergy + $totalUnshiftableEnergy - $scheduledEnergyForSupply;
          $remark = 'Energy Requirement Shifted to the next hour';
          $status = 2;
        }
      }

      array_push($energyDistributorVectors, array(
        'hour' => $i,
        'scheduledEnergyForSupply' => $scheduledEnergyForSupply,
        'totalShiftableEnergy' => $totalShiftableAndCarriedOverEnergy,
        'initialShiftableEnergy' => $totalShiftableEnergy,
        'totalUnshiftableEnergy' => $totalUnshiftableEnergy,
        'totalEnergyRequirement' => $totalEnergyRequirement,
        'totalEnergyUsed' => $totalEnergyUsed,
        'carriedOverEnergy' => $carriedOverEnergy,
        'remark' => $remark,
        'colorCode' => $colorCodes[$status],
        'color' => $colors[$status]
      ));
    }

    return view('vectors.energy-distributor', ['energyCostsArray' => $energyCostsArray,'energyDistributorVectors' => $energyDistributorVectors, 'energyDistributor' => $energyDistributor, 'usersArray' => $usersArray]);
  }
}
