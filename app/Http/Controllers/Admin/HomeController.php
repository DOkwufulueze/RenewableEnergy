<?php

namespace RenewableEnergy\Http\Controllers\Admin;

use Illuminate\Http\Request;

use RenewableEnergy\Http\Requests;
use RenewableEnergy\Http\Controllers\Controller;

class HomeController extends Controller
{
  public function index() {
    return view('admin.home');
  }

  public function assignLocationDistributorForm() {
    return view('admin.assign-location-distributor-form');
  }
}
