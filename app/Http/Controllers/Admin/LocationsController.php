<?php

namespace RenewableEnergy\Http\Controllers\Admin;

use Illuminate\Http\Request;
use RenewableEnergy\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use RenewableEnergy\Http\Controllers\Controller;

use RenewableEnergy\Admin\Location;

class LocationsController extends Controller
{
  //
  function index() {
    $locations = Location::all();
    return view('admin.locations.index', ['locations' => $locations]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    $location = new Location();
    return view('admin.locations.create', ['location' => $location]);
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
    Location::create([
      'name' => $request['name']
    ]);

    return Redirect::to('admin/locations');
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
    $location = Location::findOrFail($id);
    return view('admin.locations.edit', ['location' => $location]);
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
    $location = Location::findOrFail($id);
    if (is_null($location)) {
      return Redirect::to('devices');
    } else {
      $location->update([
        'name' => $request['name']
      ]);

      return Redirect::to('admin/locations');
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
    $location = Location::findOrFail($id);
    $location->delete();
    return Redirect::to('admin/locations');
  }
}
