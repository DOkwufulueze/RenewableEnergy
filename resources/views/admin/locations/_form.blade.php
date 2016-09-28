<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
  <label for="name" class="col-md-4 control-label">Name</label>

  <div class="col-md-6">
    <input id="name" type="text" class="form-control" name="name" value="{{ $location->name }}" required autofocus>

    @if ($errors->has('name'))
      <span class="help-block">
        <strong>{{ $errors->first('name') }}</strong>
      </span>
    @endif
  </div>
</div>

<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

<div class="form-group">
  <div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary">
      {{ $location->id ? 'Edit Location' : 'Create Location' }}
    </button>
  </div>
</div>
