<?php

namespace RenewableEnergy\Http\Controllers;

use Request;
use RenewableEnergy\Http\Requests;
use Auth;
use RenewableEnergy\DeviceType;
use RenewableEnergy\Device;
use RenewableEnergy\DeviceUsage;
use DateTime;

class DeviceUsagesController extends Controller
{
  //
  function index() {
    $user = Auth::user();
    if ($user->user_type_id == 1) {
      return Redirect::to('admin/home');
    } else {
      $devices = Device::where('user_id', $user->id)->get();
      $deviceArray = array();
      foreach ($devices as $device) {
        $deviceType = DeviceType::findOrFail($device->device_type_id);
        $deviceIsOn = DeviceUsage::where('device_id', $device->id)->where('time_off', null)->first();
        $device = array(
          'id' => $device->id,
          'name' => $device->name,
          'energyCostPerHour' => $device->energy_cost_per_hour,
          'user' => $user,
          'switchStatus' => is_null($deviceIsOn) ? '0' : '1'
        );
        array_push($deviceArray, $device);
      }

      return view('usages.index', ['devices' => $deviceArray]);
    }
  }

  function switchDevice() {
    $data = Request::all();
    $deviceId = $data['deviceId'];
    $switchStatus = $data['switchStatus'];
    $device = Device::find($deviceId);
    if (!is_null($device)) {
      if ($switchStatus == '1') { // Device is ON
        $deviceUsage = DeviceUsage::where('device_id', $deviceId)->where('time_off', null)->first();
        if (!is_null($deviceUsage)) {
          if ($deviceUsage->update(['time_off' => new DateTime()]) > 0) {
            return ['status' => 'true', 'switchStatus' => '0'];
          } else {
            return ['status' => 'false', 'message' => 'Unable to Switch device OFF.'];
          }
        } else {
          return ['status' => 'false', 'message' => 'Device Usage not found.'];
        }
      } else { // Device is OFF
        if (DeviceUsage::create(['device_id' => $deviceId, 'time_on' => new DateTime()])) {
          return ['status' => 'true', 'switchStatus' => '1'];
        } else {
          return ['status' => 'false', 'message' => 'Unable to Switch device ON.'];
        }
      }
    } else {
      return ['status' => 'false', 'message' => 'Device not found.', 'data'=>$data];
    }
  }
}
