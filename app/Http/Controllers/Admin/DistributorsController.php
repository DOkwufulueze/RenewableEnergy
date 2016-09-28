<?php

namespace RenewableEnergy\Http\Controllers\Admin;

use Illuminate\Http\Request;
use RenewableEnergy\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use RenewableEnergy\Http\Controllers\Controller;

use RenewableEnergy\Admin\Distributor;

class DistributorsController extends Controller
{
  //
  function index() {
    $distributors = Distributor::all();
    return view('admin.distributors.index', ['distributors' => $distributors]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    $distributor = new Distributor();
    return view('admin.distributors.create', ['distributor' => $distributor]);
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
    Distributor::create([
      'name' => $request['name']
    ]);

    return Redirect::to('admin/distributors');
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
    $distributor = Distributor::findOrFail($id);
    return view('admin.distributors.edit', ['distributor' => $distributor]);
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
    $distributor = Distributor::findOrFail($id);
    if (is_null($distributor)) {
      return Redirect::to('admin/distributors');
    } else {
      $distributor->update([
        'name' => $request['name']
      ]);

      return Redirect::to('admin/distributors');
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
    $distributor = Distributor::findOrFail($id);
    $distributor->delete();
    return Redirect::to('admin/distributors');
  }
}
