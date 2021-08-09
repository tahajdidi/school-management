@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        

    
        
       <table>
           <tr>
                <td><a href="{{url('preregister/parents-exist')}}"  role="button" class="btn btn-info btn-xs"><i class="material-icons"></i> @lang('parents does exist')</td>
                 <td><a href="{{url('register/student')}}"  role="button" class="btn btn-info btn-xs"><i class="material-icons"></i> @lang('parents does not exist')</td>
            </tr>
        </table>
    </div>
</div>
@endsection
