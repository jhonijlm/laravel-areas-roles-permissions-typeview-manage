@extends('layouts.dashboard-manager')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Posts</h1>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        @can('hasPermission', ["manager", "posts", "create"])
        <a href="{{ route('manager.posts.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            New
        </a>
        @endcan
    </div>
</div>
@can('hasPermission', ["manager", "posts", "list"])
<div class="row">
    <div class="col-12">
        <div class="card border">
            <div class="card card-body border-0 shadow table-wrapper table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-gray-200">Title</th>
                            <th class="border-gray-200">Content</th>
                            <th class="border-gray-200">Created By</th>
                            <th class="border-gray-200">Created At</th>
                            <th class="border-gray-200">Updated At</th>
                            <th class="border-gray-200"></th>
                            <th class="border-gray-200"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->title}}</td>
                            <td>{{ Str::substr($post->content, 0, 20)}}...</td>
                            <td>{{ $post->user->name}}</td>
                            <td>{{ $post->created_at}}</td>
                            <td>{{ $post->updated_at}}</td>
                            <td>
                                @can('update', [$post , ['manager', 'posts', 'update']])
                                <a class="btn btn-info btn-sm" href="{{ route('manager.posts.edit', ['id'=> $post->id]) }}">Edit</a>
                                @endcan
                            </td>
                            <td>
                                @can('delete', [$post , ['manager', 'posts', 'delete']])
                                <form action="{{ route('manager.posts.delete', ['id' => $post->id]) }}" method="POST" onsubmit="return confirm('Are you sure delete?')" >
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                    <nav aria-label="Page navigation example">
                        {{ $posts->links()}}
                    </nav>
                    <div class="fw-normal small mt-4 mt-lg-0">Showing <b>{{ $posts->count()}}</b> out of <b>{{ $posts->total()}}</b> entries</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection
