@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-am-6 ml-3">
                <a href="{{ url()->previous() }}" type="button">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Complain Type Panel</h1>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Complain Type</h3>
                </div>
                <div class="card-body">
                    @include('complain_types._form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection