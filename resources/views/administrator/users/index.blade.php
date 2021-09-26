@extends('layouts.dashboard-admin')

@section('content')



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Users</h1>
    </div>
    <div class="btn-toolbar mb-2 mb-md-0">
        @can('hasPermission', ["administrator", "users", "create"])
        <a href="{{ route('administrator.users.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            New
        </a>
        @endcan
    </div>
</div>
@can('hasPermission', ["administrator", "users", "list"])
<div class="row">
    <div class="col-12">
        <div class="card border">
            <div class="card card-body border-0 shadow table-wrapper table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-gray-200">#</th>
                            <th class="border-gray-200">First Name</th>
                            <th class="border-gray-200">Last Name</th>
                            <th class="border-gray-200">Email Address</th>
                            <th class="border-gray-200">Cell Phone</th>
                            <th class="border-gray-200">Roles</th>
                            <th class="border-gray-200">Address</th>
                            <th class="border-gray-200"></th>
                            <th class="border-gray-200"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id}}</td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->last_name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->cell_phone}}</td>
                            <td>{{ $user->roles->pluck("name")->join(', ', ' and ')}}</td>
                            <td>{{ Str::substr($user->address, 0, 20)}}...</td>
                            <td>
                                @can('update', [$user , ['administrator', 'users', 'update']])
                                    <a class="btn btn-info btn-sm" href="{{ route('administrator.users.edit', ['id'=> $user->id]) }}">Edit</a>
                                @endcan
                            </td>
                            <td>
                                @can('delete', [$user , ['administrator', 'users', 'delete']])
                                    <form action="{{ route('administrator.users.delete', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure delete?')" >
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
                        {{ $users->links()}}
                    </nav>
                    <div class="fw-normal small mt-4 mt-lg-0">Showing <b>{{ $users->count()}}</b> out of <b>{{ $users->total()}}</b> entries</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
@endsection
