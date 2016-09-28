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

class LocationDistributorsController extends Controller
{
  //
  function index() {
    $locationDistributors = LocationDistributor::all();
    $locationDistributorsArray = array();
    foreach ($locationDistributors as $locationDistributor) {
      $location = Location::find($locationDistributor->location_id);
      $distributor = Distributor::find($locationDistributor->distributor_id);
      $energyPerHour = $locationDistributor->scheduled_energy_per_hour;
      // $energyUsed = 
      array_push($locationDistributorsArray, array(
        'id' => $locationDistributor->id,
        'location' => $location->name,
        'distributor' => $distributor->name,
        'scheduled_energy_per_hour' => $energyPerHour
      ));
    }

    return view('admin.location-distributors.index', ['locationDistributors' => $locationDistributorsArray]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    $locationDistributor = new LocationDistributor();
    $locations = Location::all();
    $distributors = Distributor::all();
    return view('admin.location-distributors.create', ['locationDistributor' => $locationDistributor, 'locations' => $locations, 'distributors' => $distributors]);
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
    LocationDistributor::create([
      'location_id' => $request['location_id'],
      'distributor_id' => $request['distributor_id'],
      'scheduled_energy_per_hour' => $request['scheduled_energy_per_hour']
    ]);

    return Redirect::to('admin/location-distributors');
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
    $locationDistributor = LocationDistributor::findOrFail($id);
    $locations = Location::all();
    $distributors = Distributor::all();
    return view('admin.location-distributors.edit', ['locationDistributor' => $locationDistributor, 'locations' => $locations, 'distributors' => $distributors]);
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
    $locationDistributor = LocationDistributor::findOrFail($id);
    if (is_null($locationDistributor)) {
      return Redirect::to('admin/location-distributors');
    } else {
      $locationDistributor->update([
        'scheduled_energy_per_hour' => $request['scheduled_energy_per_hour']
      ]);

      return Redirect::to('admin/location-distributors');
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
    $locationDistributor = LocationDistributor::findOrFail($id);
    $locationDistributor->delete();
    return Redirect::to('admin/location-distributors');
  }
}
