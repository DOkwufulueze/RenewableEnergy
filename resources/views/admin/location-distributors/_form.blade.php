<div class="form-group{{ $errors->has('location_id') ? ' has-error' : '' }}">
  <label for="location_id" class="col-md-4 control-label">Location</label>

  <div class="col-md-6">
     <select id="location_id" type="location" class="form-control" name="location_id" required {{ $locationDistributor->id ? 'disabled' : '' }}>
      @foreach ($locations as $location)
        <option value="{{ $location['id'] }}" {{ $location->id == $locationDistributor->location_id ? 'selected' : '' }}>{{ $location->name }}</option>
      @endforeach
    </select>

    @if ($errors->has('location_id'))
      <span class="help-block">
        <strong>{{ $errors->first('location_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('distributor_id') ? ' has-error' : '' }}">
  <label for="distributor_id" class="col-md-4 control-label">Distributor</label>

  <div class="col-md-6">
     <select id="distributor_id" type="distributor" class="form-control" name="distributor_id" required {{ $locationDistributor->id ? 'disabled' : '' }}>
      @foreach ($distributors as $distributor)
        <option value="{{ $distributor['id'] }}" {{ $distributor->id == $locationDistributor->distributor_id ? 'selected' : '' }}>{{ $distributor->name }}</option>
      @endforeach
    </select>

    @if ($errors->has('distributor_id'))
      <span class="help-block">
        <strong>{{ $errors->first('distributor_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('scheduled_energy_per_hour') ? ' has-error' : '' }}">
  @for ($i = 0; $i < 24; $i++)
    <label for="scheduled_energy_per_hour<?php echo $i; ?>" class="col-md-4 control-label">Scheduled Energy for Hour <?php echo $i + 1; ?></label>
    <div class="col-md-6">
      <input type="number" id="scheduled_energy_per_hour<?php echo $i; ?>" type="scheduled_energy_per_hour" class="form-control" name="scheduled_energy_per_hour[]" value="{{ json_decode($locationDistributor->scheduled_energy_per_hour)[$i] ? json_decode($locationDistributor->scheduled_energy_per_hour)[$i] : 0 }}" placeholder="Hour <?php echo $i + 1; ?> Default = 0">

      @if ($errors->has('scheduled_energy_per_hour'))
        <span class="help-block">
          <strong>{{ $errors->first('scheduled_energy_per_hour') }}</strong>
        </span>
      @endif
    </div>
  @endfor
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary" <?php if (count($locations) == 0 || count($distributors) == 0) {echo 'disabled';} ?> >
      {{ $locationDistributor->id ? 'Edit Location Distributor' : 'Create Location Distributor' }}
    </button>
  </div>
</div>
