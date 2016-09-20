<?php

namespace RenewableEnergy\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use RenewableEnergy\Http\Requests;
// use RenewableEnergy\User;
use Auth;
use RenewableEnergy\DeviceType;
use RenewableEnergy\Device;

class DevicesController extends Controller
{

  //
  function index() {
    $user = Auth::user();
    $devices = Device::where('user_id', $user->id)->get();
    $deviceArray = array();
    foreach ($devices as $device) {
      $deviceType = DeviceType::findOrFail($device->device_type_id);
      $device = array(
        'id' => $device->id,
        'name' => $device->name,
        'energyCostPerHour' => $device->energy_cost_per_hour,
        'user' => $user,
        'deviceType' => $deviceType
      );
      array_push($deviceArray, $device);
    }

    return view('devices.index', ['devices' => $deviceArray]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    $device = new Device();
    $deviceTypes = DeviceType::all();
    return view('devices.create', ['device' => $device, 'deviceTypes' => $deviceTypes, 'user_id' => 1]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
    Device::create([
      'name' => $request['name'],
      'energy_cost_per_hour' => $request['energy_cost_per_hour'],
      'device_type_id' => $request['device_type_id'],
      'user_id' => $request['user_id']
    ]);

    return Redirect::to('devices');//, ['message' => 'Device saved successfully']);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
    $deviceTypes = DeviceType::all();
    $device = Device::findOrFail($id);
    return view('devices.edit', ['device' => $device, 'deviceTypes' => $deviceTypes, 'user_id' => 1]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
    $device = Device::findOrFail($id);
    if (is_null($device)) {
      return Redirect::to('devices');
    } else {
      $device->update([
        'name' => $request['name'],
        'energy_cost_per_hour' => $request['energy_cost_per_hour'],
        'device_type_id' => $request['device_type_id'],
        'user_id' => $request['user_id']
      ]);

      return Redirect::to('devices');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
    $device = Device::find($id);
    $device->delete();
    return Redirect::to('devices');
  }
}
