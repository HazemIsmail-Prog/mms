@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @livewire('customer-form',[
                'action' => 'edit',
                'customer' => $customer,
                ])
            </div>
        </div>
    </div>
@endsection
