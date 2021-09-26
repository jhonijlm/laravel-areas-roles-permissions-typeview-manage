@csrf

<div class="mb-3">
    <label>Title</label>
    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{ $post->title ?? old('title')}}">
    @if ($errors->has('title'))
        <div class="invalid-feedback">
            {{ $errors->first('title') }}
        </div>
    @endif
</div>
<div class="mb-3">
    <label>Content</label>
    <textarea name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" cols="30" rows="10">{{ $post->content ?? old('content')}}</textarea>
    @if ($errors->has('content'))
        <div class="invalid-feedback">
            {{ $errors->first('content') }}
        </div>
    @endif
</div>

<div class="mb-3">
    <button class="btn btn-gray-800 form-control" id="btn-submit">Save</button>
</div>

