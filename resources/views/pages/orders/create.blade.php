@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
               @livewire('order-form',[
                'customer' => $customer,
                'action' => 'create'
                ])
            </div>
        </div>
    </div>
@endsection
