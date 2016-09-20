<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
  <label for="name" class="col-md-4 control-label">Name</label>

  <div class="col-md-6">
    <input id="name" type="text" class="form-control" name="name" value="{{ $device->name }}" required autofocus>

    @if ($errors->has('name'))
      <span class="help-block">
        <strong>{{ $errors->first('name') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('energy_cost_per_hour') ? ' has-error' : '' }}">
  <label for="energy_cost_per_hour" class="col-md-4 control-label">Energy Cost / Hour</label>

  <div class="col-md-6">
    <input type="number" id="energy_cost_per_hour" type="energy_cost_per_hour" class="form-control" name="energy_cost_per_hour" value="{{ $device->energy_cost_per_hour }}" required>

    @if ($errors->has('energy_cost_per_hour'))
      <span class="help-block">
        <strong>{{ $errors->first('energy_cost_per_hour') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('device_type_id') ? ' has-error' : '' }}">
  <label for="device_type_id" class="col-md-4 control-label">Device Type</label>

  <div class="col-md-6">
    <select id="device_type_id" type="device_type_id" class="form-control" name="device_type_id" required>
      @foreach ($deviceTypes as $deviceType)
        <option value="{{ $deviceType['id'] }}" {{ $deviceType->id == $device->device_type_id ? 'selected' : '' }}>{{ $deviceType->name }}</option>
      @endforeach
    </select>

    @if ($errors->has('device_type_id'))
      <span class="help-block">
        <strong>{{ $errors->first('device_type_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

<div class="form-group">
  <div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary">
      {{ $device->id ? 'Edit Device' : 'Create Device' }}
    </button>
  </div>
</div>
