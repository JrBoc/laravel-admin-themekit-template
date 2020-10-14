@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-bar-chart-2 bg-dark"></i>
                <div class="d-inline">
                    <h5>Profile</h5>
                    <span>Manage your Profile</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <h5><b>Profile Details</b></h5>
    </div>
    <div class="col-md-9">
        @livewire('admin.profile.edit')
    </div>
    <div class="col-12 mb-25">
        <hr>
    </div>
    <div class="col-md-3">
        <h5><b>Password</b></h5>
    </div>
    <div class="col-md-9">
        @livewire('admin.profile.password')
    </div>
    <div class="col-12 mb-25">
        <hr>
    </div>
    <div class="col-md-3">
        <h5><b>Your Roles and Permissions</b></h5>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <ul class="list-group">
                            @if(!$is_super_admin)
                                @forelse($user->roles as $role)
                                    <li class="list-group-item">
                                        <strong class="d-block" style="font-size: large">{{ $role->name }}</strong>
                                        @foreach ($role->permissions as $permission)
                                            <span class="d-block">
                                                <i class="ik ik-check"></i>
                                                {{ ucwords(str_replace('_', ' ', explode('.', $permission->name)[0])) . ' - ' . ucwords(str_replace('_', ' ', explode('.', $permission->name)[1])) }}
                                            </span>
                                        @endforeach
                                    </li>
                                @empty
                                    <li class="list-group-item-danger">
                                        <b> You have no assigned roles or permissions</b>
                                    </li>
                                @endforelse
                            @else
                                <li class="list-group-item">
                                    <strong class="d-block" style="font-size: large">Super Admin</strong>
                                    You can do anything. Your a Super Hero.
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
