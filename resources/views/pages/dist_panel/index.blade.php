@extends('layouts.app')

@section('content')
    <style>
        .box > div {
            z-index: 10;
        }
    </style>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>{{$department->name}}</div>
                    </div>
                    <div class="card-body">
                        @livewire('dist-panel' , [
                        'department' => $department,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


