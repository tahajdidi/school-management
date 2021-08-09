@extends('layouts.app')

@section('title', __('Parents'))

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
                <div class="page-panel-title">@lang('List of all') {{ucfirst($user->parents->role)}}</div>
                 @break($loop->first)
              @endforeach
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.users-export',['type'=>'parents'])
                        
                    @endcomponent
                    {{$users->links()}}
<div class="table-responsive">
<table class="table table-bordered table-data-div table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
     
      <th scope="col">@lang('Code of student')</th>
      <th scope="col">@lang('Full Name')</th>
      <th scope="col">@lang('send message')</th>
      @if (!Session::has('section-attendance'))
      <th scope="col">@lang('Gender')</th>
      <th scope="col">@lang('Phone')</th>
    
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key=>$user)
    <tr>
      <th scope="row">{{ ($current_page-1) * $per_page + $key + 1 }}</th>
     
      <td><small>{{$user->student->student_code}}:{{$user->student->name}}</small></td>
      <td>
        <small>
          @if(!empty($user->pic_path))
            <img src="{{asset('01-progress.gif')}}" data-src="{{url($user->pic_path)}}" style="border-radius: 50%;" width="25px" height="25px">
          @else
            @if(strtolower($user->gender) == trans('male'))
              <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/guest-male--v1.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
            @else
              <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/businesswoman.png" style="border-radius: 50%;" width="25px" height="25px">&nbsp;
            @endif
          @endif
          
            {{$user->parents->name}}
          </small></td>
          <td><small><a href="{{url('notifications/'.Auth::user()->id.'/'.$user->parents->id)}}"  role="button" class="btn btn-info btn-xs"><i class="material-icons">message</i> @lang('Message Parents')</small></td>
          <td><small>{{$user->parents->gender}}</small></td>
          <td><small>{{$user->parents->phone_number}}</small></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
{{$users->links()}}

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