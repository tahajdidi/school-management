@extends('layouts.app')

@section('title', __('Students'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                @if(count($users) > 0)
                @foreach ($users as $user)
                @if (Session::has('section-attendance'))
                <ol class="breadcrumb" style="margin-top: 3%;">
                    <li><a href="{{url('school/sections?att=1')}}" style="color:#3b80ef;">@lang('Classes &amp; Sections')</a></li>
                    <li class="active">{{ucfirst($user[0]->role)}}s</li>
                </ol>
                @endif
                <div class="page-panel-title">@lang('List of my children')</div>
                @break($loop->first)
                @endforeach
                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    @component('components.users-export',['type'=>'student'])

                    @endcomponent


                    <div class="table-responsive">
                        <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>

                                    <th scope="col">@lang('Code')</th>
                                    <th scope="col">@lang('Full Name')</th>
                                    @foreach ($users as $user)
                                    @if($user[0]->role == 'student')
                                    @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
                                    <th scope="col">@lang('Attendance')</th>
                                    {{--@if (!Session::has('section-attendance'))
            <th scope="col">@lang('Marks')</th>
            @endif --}}
                                    @endif
                                    @if (!Session::has('section-attendance'))
                                    <th scope="col">@lang('Session')</th>
                                    <th scope="col">@lang('Version')</th>
                                    <th scope="col">@lang('Class')</th>
                                    <th scope="col">@lang('Section')</th>
                                    <th scope="col">@lang('Father')</th>
                                    <th scope="col">@lang('Mother')</th>
                                    @endif
                                    @elseif($user[0]->role == 'teacher')
                                    @if (!Session::has('section-attendance'))
                                    <th scope="col">@lang('Email')</th>
                                    @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
                                    <th scope="col">@lang('Courses')</th>
                                    @endif
                                    @endif
                                    @elseif($user[0]->role == 'accountant' || $user[0]->role == 'librarian')
                                    @if (!Session::has('section-attendance'))
                                    <th scope="col">@lang('Email')</th>
                                    @endif
                                    @endif
                                    @break($loop->first)
                                    @endforeach
                                    @if (!Session::has('section-attendance'))
                                    <th scope="col">@lang('Gender')</th>
                                    <th scope="col">@lang('Blood')</th>
                                    <th scope="col">@lang('Phone')</th>
                                    <th scope="col">@lang('Address')</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key=>$user)
                                <tr>

                                    @if(Auth::user()->role == 'admin')
                                    @if (!Session::has('section-attendance'))
                                    <td>
                                        <a class="btn btn-xs btn-danger" href="{{url('edit/user/'.$user[0]->id)}}">@lang('Edit')</a>
                                    </td>
                                    @endif
                                    @endif
                                    <td><small>{{$user[0]->student_code}}</small></td>
                                    <td>
                                        <small>
                                            @if(!empty($user->pic_path))
                                            <img src="{{asset('01-progress.gif')}}" data-src="{{url($user->pic_path)}}" style="border-radius: 50%;" width="25px" height="25px">
                                            @else
                                            @if(strtolower($user[0]->gender) == trans('male'))
                                            <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/guest-male--v1.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
                                            @else
                                            <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/businesswoman.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
                                            @endif
                                            @endif
                                            <a href="{{url('user/'.$user[0]->student_code)}}">
                                                {{$user[0]->name}}</a>
                                        </small>
                                    </td>
                                    @if($user[0]->role == 'student')
                                    @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin' || Auth::user()->role == 'parents' )
                                    <td><small><a class="btn btn-xs btn-info" role="button" href="{{url('attendances/0/'.$user[0]->id.'/0')}}">@lang('View Attendance')</a></small></td>
                                    {{--@if (!Session::has('section-attendance'))
          <td><small><a class="btn btn-xs btn-success" role="button" href="{{url('grades/'.$user[0]->id)}}">@lang('View Marks')</a></small></td>
                                    @endif --}}
                                    @endif
                                    @if (!Session::has('section-attendance'))
                                    <td>
                                        <small>
                                            @isset($user[0]->studentInfo['session'])
                                            {{$user[0]->studentInfo['session']}}
                                            @if($user[0]->studentInfo['session'] == now()->year || $user[0]->studentInfo['session'] > now()->year)
                                            <span class="label label-success">@lang('Promoted/New')</span>
                                            @else
                                            <span class="label label-danger">@lang('Not Promoted')</span>
                                            @endif
                                            @endisset
                                        </small>
                                    </td>
                                    <td><small>
                                            @isset($user[0]->studentInfo['version'])
                                            {{ucfirst($user[0]->studentInfo['version'])}}
                                            @endisset</small></td>
                                    <td><small>{{$user[0]->section->class->class_number}} {{!empty($user->group)? '- '.$user->group:''}}</small></td>
                                    <td style="white-space: nowrap;"><small>{{$user[0]->section->section_number}}
                                            {{-- @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
            - <a class="btn btn-xs btn-primary" role="button" href="{{url('courses/0/'.$user[0]->section->id)}}">@lang('All Courses')</a>
                                            @endif --}}
                                        </small>
                                    </td>
                                    <td><small>
                                            @isset($user[0]->studentInfo['father_name'])
                                            {{$user[0]->studentInfo['father_name']}}
                                            @endisset</small></td>
                                    <td><small>
                                            @isset($user[0]->studentInfo['mother_name'])
                                            {{$user[0]->studentInfo['mother_name']}}
                                            @endisset</small></td>
                                    @endif
                                    @elseif($user[0]->role == 'teacher')
                                    @if (!Session::has('section-attendance'))
                                    <td>
                                        <small>{{$user[0]->email}}</small>
                                    </td>
                                    @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
                                    <td style="white-space: nowrap;">
                                        <small>
                                            <a href="{{url('courses/'.$user[0]->id.'/0')}}">@lang('All Courses')</a>
                                        </small>
                                    </td>
                                    @endif
                                    @endif
                                    @elseif($user[0]->role == 'accountant' || $user[0]->role == 'librarian')
                                    @if (!Session::has('section-attendance'))
                                    <td>
                                        <small>{{$user[0]->email}}</small>
                                    </td>
                                    @endif
                                    @endif
                                    @if (!Session::has('section-attendance'))
                                    <td><small>{{ucfirst($user[0]->gender)}}</small></td>
                                    <td><small>{{$user[0]->blood_group}}</small></td>
                                    <td><small>{{$user[0]->phone_number}}</small></td>
                                    <td><small>{{$user[0]->address}}</small></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                @else
                <div class="panel-body">
                    @lang('No Related Data Found.')
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection