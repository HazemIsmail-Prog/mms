@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route('roles.update',$role)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header">@lang('messages.add_role')</div>
                        <div class="card-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('success') }}
                                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                </div>
                            @endif


                            <div class="form-group">
                                <label for="name_ar">@lang('messages.name_ar')</label>
                                <input autofocus type="text" name="name_ar" value="{{old('name_ar',$role->name_ar)}}"
                                       class="form-control @error('name_ar') is-invalid @enderror">
                                @error('name_ar')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="name_en">@lang('messages.name_en')</label>
                                <input autofocus type="text" name="name_en" value="{{old('name_en',$role->name_en)}}"
                                       class="form-control @error('name_en') is-invalid @enderror">
                                @error('name_en')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="card">
                                <div class="card-header">{{__('messages.permissions')}}</div>
                                <div class="card-body">
                                    @error('permissions')<span class="small text-danger">{{ $message }}</span>@enderror
                                    @foreach($permissions as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$permission->id}}"
                                                   {{$role->permissions->pluck('id')->contains($permission->id) ? 'checked' : ''}}
                                                   name="permissions[]"
                                                   id="{{$permission->id}}">
                                            <label class="form-check-label" for="{{$permission->id}}">
                                                {{$permission->description}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-facebook" type="submit">@lang('messages.save')</button>
                            <a href="{{route('roles.index')}}" class="btn text-danger"
                               type="button">@lang('messages.back')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
