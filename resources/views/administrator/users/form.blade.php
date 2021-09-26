@csrf
<div class="mb-3">
    <label>Select Roles</label>
    <select class="form-select {{ $errors->has('roles') ? 'is-invalid' : '' }}" multiple name="roles[]">
        @foreach ($roles as $role)
            <option  value="{{ $role->id}}" {{ isset($user) ? ($user->roles->where("slug", $role->slug)->first() ? 'selected' : '') : ''}}> {{ $role->name}}</option>
        @endforeach
    </select>
    @if ($errors->has('roles'))
        <div class="invalid-feedback">
            {{ $errors->first('roles') }}
        </div>
    @endif
</div>

<div class="mb-3">
    <label>First Name</label>
    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ $user->name ?? old('name')}}">
    @if ($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    @endif
</div>

<div class="mb-3">
    <label>Last Name</label>
    <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" name="last_name" value="{{ $user->last_name ?? old('last_name')}}">
    @if ($errors->has('last_name'))
        <div class="invalid-feedback">
            {{ $errors->first('last_name') }}
        </div>
    @endif
</div>

<div class="mb-3">
    <label>Email address</label>
    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ $user->email ?? old('email')}}">
    @if ($errors->has('email'))
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
    @endif
</div>

<div class="mb-3">
    <label>Cell Phone</label>
    <input type="text" class="form-control {{ $errors->has('cell_phone') ? 'is-invalid' : '' }}" name="cell_phone" value="{{ $user->cell_phone ?? old('cell_phone')}}">
    @if ($errors->has('cell_phone'))
        <div class="invalid-feedback">
            {{ $errors->first('cell_phone') }}
        </div>
    @endif
</div>
<div class="mb-3">
    <label>Password</label>
    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password"  value="{{ $user->password ?? old('password')}}" >
    @if ($errors->has('password'))
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
    @endif
</div>
<div class="mb-3">
    <button class="btn btn-gray-800 form-control" id="btn-submit">Save</button>
</div>

