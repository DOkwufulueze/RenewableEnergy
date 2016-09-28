<?php

namespace RenewableEnergy\Http\Controllers\Admin;

use Illuminate\Http\Request;
use RenewableEnergy\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use RenewableEnergy\Http\Controllers\Controller;

use RenewableEnergy\Admin\LocationDistributor;
use RenewableEnergy\Admin\Location;
use RenewableEnergy\Admin\Distributor;
use RenewableEnergy\User;

class UserLocationDistributorController extends Controller
{
  function index() {
    $users = User::where('user_type_id', 2)->get();
    $userLocationDistributorsArray = array();
    foreach ($users as $user) {
      $locationDistributorId = $user->location_distributor_id;
      $location = $locationDistributorId != 0 ? Location::find(LocationDistributor::find($locationDistributorId)->location_id) : array('name' => 'Not Set');
      $distributor = $locationDistributorId != 0 ? Distributor::find(LocationDistributor::find($locationDistributorId)->distributor_id) : array('name' => 'Not Set');
      array_push($userLocationDistributorsArray, array(
        'id' => $user->id,
        'user' => $user,
        'location' => $location,
        'distributor' => $distributor
      ));
    }

    return view('admin.user-location-distributors.index', ['userLocationDistributors' => $userLocationDistributorsArray, 'users' => $users]);
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
    $user = User::findOrFail($id);
    $locationDistributors = LocationDistributor::all();
    $locationDistributorsArray = array();
    foreach ($locationDistributors as $locationDistributor) {
      $location = Location::find($locationDistributor->location_id);
      $distributor = Distributor::find($locationDistributor->distributor_id);
      array_push($locationDistributorsArray, array(
        'id' => $locationDistributor->id,
        'location' => $location->name,
        'distributor' => $distributor->name
      ));
    }

    return view('admin.user-location-distributors.edit', ['user' => $user, 'locationDistributors' => $locationDistributorsArray]);
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
    $user = User::findOrFail($id);
    if (is_null($user)) {
      return Redirect::to('admin/user-location-distributors');
    } else {
      $user->location_distributor_id = $request['location_distributor_id'];
      $user->save();
      return Redirect::to('admin/user-location-distributors');
    }
  }
}
