@extends('layouts.dashboard-admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="mb-3 mb-lg-0">
        <h1 class="h4">Create User</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card border">
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('administrator.users.store') }}" method="POST" onsubmit="document.getElementById('btn-submit').disabled = true">
                        @include('administrator.users.form')
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
