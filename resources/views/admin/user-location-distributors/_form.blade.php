<div class="form-group{{ $errors->has('location_id') ? ' has-error' : '' }}">
  <label for="location_id" class="col-md-4 control-label">Name</label>

  <div class="col-md-6">
     {{ $user->name }}
  </div>
</div>

<div class="form-group{{ $errors->has('location_distributor_id') ? ' has-error' : '' }}">
  <label for="location_distributor_id" class="col-md-4 control-label">Location / Distributor</label>

  <div class="col-md-6">
     <select id="location_distributor_id" type="location_distributor" class="form-control" name="location_distributor_id" required>
      @foreach ($locationDistributors as $locationDistributor)
        <option value="{{ $locationDistributor['id'] }}" {{ $user->location_distributor_id == $locationDistributor['id'] ? 'selected' : '' }}>{{ $locationDistributor['location'] }} / {{ $locationDistributor['distributor'] }}</option>
      @endforeach
    </select>

    @if ($errors->has('location_distributor_id'))
      <span class="help-block">
        <strong>{{ $errors->first('location_distributor_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary" <?php if (count($locationDistributors) == 0) {echo 'disabled';} ?> >
      Edit User Location Distributor
    </button>
  </div>
</div>
