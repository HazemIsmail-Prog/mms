@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route('artisan.run')}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">@lang('messages.artisan_commands')</div>
                        <div class="card-body">
                            <h4>migrate</h4>
                            <h4>db:seed --class=OrderSeeder</h4>
                            <h4>migrate:fresh</h4>
                            <h4>migrate:fresh --seed</h4>
                            <hr>
                            <h4>cache:clear</h4> 
                            <h4>view:clear</h4> 
                            <h4>route:clear</h4> 
                            <h4>clear-comh4iled</h4> 
                            <h4>config:cache</h4> 
                            <hr>
                            <h4>websockets:serve</h4>
                            <hr>
                            <div class="form-group">
                                <input autofocus type="text" name="command" value="{{old('command')}}"
                                       class="form-control @error('command') is-invalid @enderror">
                                @error('command')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-facebook" type="submit">@lang('messages.run')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
