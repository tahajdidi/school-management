@extends('layouts.app')

@section('title', __('Parents'))

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-8" id="main-container">
            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
                {{-- Display View admin links --}}
                @if (session('register_school_id'))
                <a href="{{ url('school/admin-list/' . session('register_school_id')) }}" target="_blank" class="text-white pull-right">@lang('View Admins')</a>
                @endif
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" method="get" id="selectparentsID" action="{{ url('checkID') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('parents_id') ? ' has-error' : '' }}">
                            <label for="parents_id" class="col-md-4 control-label">@lang('parents id')</label>

                            <div class="col-md-6">
                                <input id="parents_id" type="text" class="form-control" name="parents_id" value="{{ old('parents_id') }}">

                                @if ($errors->has('parents_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('parents_id') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>
                        <div class="form-group">
                            <div class=" col-md-6 col-md-offset-4">
                                <button type="submit" id="checkIDBtn" class="btn btn-primary">
                                    @lang('Register')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection