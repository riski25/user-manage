@extends('layouts.app')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@section('content')
<div class="container">
    <h5 class="font-bold" style="padding-right:15px;padding-left:15px;">
        <div>
            <p class="float-right">
                Total Users
                {{-- {{ $users}} --}}
                <span class="badge badge-info"> {{ count($users)}}</span>
            </p>
        </div>
    </h5>
    <div class="row">
        <div class="col-md-6">
            <!-- Page Heading -->
            <div class="card">
                <div class="card-header">
                    <h2>Selamat datang, <b>{{ Auth()->user()->name}}</b></h2>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>
@endsection
