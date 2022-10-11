@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="{{route('users.store')}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">@lang('messages.add_user')</div>
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
                                <input autocomplete="off" type="text" name="name_ar" value="{{old('name_ar')}}"
                                       class="form-control @error('name_ar') is-invalid @enderror">
                                @error('name_ar')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="name_en">@lang('messages.name_en')</label>
                                <input autocomplete="off" type="text" name="name_en" value="{{old('name_en')}}"
                                       class="form-control @error('name_en') is-invalid @enderror">
                                @error('name_en')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="username">@lang('messages.username')</label>
                                <input autocomplete="off" type="text" name="username" value="{{old('username')}}"
                                       class="form-control @error('username') is-invalid @enderror">
                                @error('username')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="email">@lang('messages.email')</label>
                                <input autocomplete="off" type="email" name="email" value="{{old('email')}}"
                                       class="form-control @error('email') is-invalid @enderror">
                                @error('email')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="password">@lang('messages.password')</label>
                                <input autocomplete="off" type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror">
                                @error('password')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="title_id">@lang('messages.title')</label>
                                <select name="title_id"
                                        class="form-control @error('title_id') is-invalid @enderror">
                                    <option value="">---</option>
                                    @foreach($titles as $title)
                                        <option
                                            value="{{$title->id}}" {{old('title_id') == $title->id ? 'selected' : ''}}>{{$title->name}}</option>
                                    @endforeach
                                </select>
                                @error('title_id')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="role">@lang('messages.role')</label>
                                <select name="role"
                                        class="form-control @error('role') is-invalid @enderror">
                                    <option value="">---</option>
                                    @foreach($roles as $role)
                                        <option
                                            value="{{$role->id}}" {{old('role') == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role')<span class="small text-danger">{{ $message }}</span>@enderror
                            </div>
                                <div class="card">
                                    <div class="card-header">{{__('messages.departments')}}</div>
                                    <div class="card-body">
                                        @error('departments')<span class="small text-danger">{{ $message }}</span>@enderror
                                        @foreach($departments as $department)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{$department->id}}"
                                                       {{in_array($department->id, old("departments") ?: []) ? 'checked': ''}}
                                                       name="departments[]"
                                                       id="{{$department->id}}">
                                                <label class="form-check-label" for="{{$department->id}}">
                                                    {{$department->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            <div class="form-group">
                                <label for="name">@lang('messages.status')</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           name="active" {{old('active') ? 'checked' : ''}}>
                                    <label class="form-check-label" for="active">
                                        @lang('messages.active')
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-facebook" type="submit">@lang('messages.save')</button>
                            <a href="{{route('users.index')}}" class="btn text-danger"
                               type="button">@lang('messages.back')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
