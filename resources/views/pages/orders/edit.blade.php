@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @livewire('order-form',[
                'order' => $order,
                'action' => 'edit'
                ])
            </div>
        </div>
    </div>
@endsection
