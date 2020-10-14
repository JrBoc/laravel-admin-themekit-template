@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="ik ik-bar-chart-2 bg-dark"></i>
                <div class="d-inline">
                    <h5>Dashboard</h5>
                    <span>Your home is here</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#dashboard"><i class="ik ik-home"></i></a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Title 1</h6>
                        <h2>Subtitle 1</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-users"></i>
                    </div>
                </div>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Title 2</h6>
                        <h2>Subtitle 2</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-shopping-bag"></i>
                    </div>
                </div>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-success" role="progressbar" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Title 3</h6>
                        <h2>Subtitle 3</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-package"></i>
                    </div>
                </div>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="widget">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="state">
                        <h6>Title 4</h6>
                        <h2>Subtitle 4</h2>
                    </div>
                    <div class="icon">
                        <i class="ik ik-heart-on"></i>
                    </div>
                </div>
            </div>
            <div class="progress progress-sm">
                <div class="progress-bar bg-info" role="progressbar" style="width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
@endsection
