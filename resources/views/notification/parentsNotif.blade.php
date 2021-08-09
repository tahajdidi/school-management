@extends('layouts.app')

@section('title', __('Course Students'))

@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<style>
.ck-editor__editable{
    min-height: 200px;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-6">
                        
                        <form action="{{url('message/parents')}}" method="POST" id="msgPar">
                            {{ csrf_field() }}
                            <input type="hidden" name="admin_id" value="{{$admin_id}}">
                            <input type="hidden" name="parents_id" value="{{$parents_id}}">
                            
                            <div class="form-group">
                                <label for="msg">@lang('Write Message'): </label>
                                <textarea name="msg" class="form-control" id="msg" cols="30" rows="10"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger btn-sm"><i class="material-icons">send</i> @lang('Send Message')</button>
                        </form>
                    </div>
                </div>
                <script>
                    $(function () {
                        var r = $(':checkbox[name="recipients[]"]');
                        $('#selectAll').on('change', function () {
                            if ($(this).is(':checked')) {
                                r.prop('checked', true);
                            } else {
                                r.prop('checked', false);
                            }
                        });
                        ClassicEditor
                            .create(document.querySelector('#msg'), {
                                toolbar: ['bold', 'italic','Heading', 'Link', 'bulletedList', 'numberedList', 'blockQuote']
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    });

                </script>
            </div>
        </div>
    </div>
</div>
@endsection
