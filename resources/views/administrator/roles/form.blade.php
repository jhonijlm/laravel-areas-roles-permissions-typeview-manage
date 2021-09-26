@csrf
<div class="mb-3">
    <label>Select Areas</label>
    <select class="form-select {{ $errors->has('areas') ? 'is-invalid' : '' }}" multiple name="areas[]" id="selectArea" required>
        @foreach ($areas as $area)
            <option value="{{ $area->id}}" {{ isset($role) ? ($role->areas->where("slug", $area->slug)->first() ? 'selected' : '') : ''}}  >{{ $area->name}}</option>
        @endforeach
    </select>
    @if ($errors->has('areas'))
        <div class="invalid-feedback">
            {{ $errors->first('areas') }}
        </div>
    @endif
</div>

<div class="mb-3">
    <label>Name</label>
    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ $role->name ?? old('name')}}" required>
    @if ($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    @endif
</div>

<div class="mb-3">
    <label>Slug</label>
    <input type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" name="slug" value="{{ $role->slug ?? old('slug')}}" required>
    @if ($errors->has('slug'))
        <div class="invalid-feedback">
            {{ $errors->first('slug') }}
        </div>
    @endif
</div>

<div class="mb-3">
    <label>Areas</label>
    <input type="hidden" id="updatedAreas" name="updatedAreas" value="">
    <div id="content">
    </div>
</div>


<div class="mb-3">
    <button class="btn btn-gray-800 form-control" id="btn-submit">Save</button>
</div>

