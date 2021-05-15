@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>

                    <span>Select files...</span>

                    <input id="fileupload" type="file" name="documento"
                    data-token="{!! csrf_token() !!}"
                    data-user-id="{!! $user->id !!}">

                    </span>
                    <br>
                    <br>
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>

                    @if(Session::has('success'))

                        <div class="alert alert-success">
                            {!! Session::get('success') !!}
                        </div>

                    @endif
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Enviado em</th>
                                <th>Usuário</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->documents as $document)
                            <tr>
                                <td>{!! $document->name !!}</td>
                                <td>{!! $document->created_at !!}</td>
                                <td>{!! $user->name !!}</td>
                                <td>
                                    <a 
                                    href="{!! route('files.download', [$user->id, $document->id]) !!}" 
                                    class="btn btn-xs btn-success">Download</a>
                                    <a 
                                    href="{!! route('files.destroy', [$user->id, $document->id]) !!}" 
                                    class="btn btn-xs btn-danger">Excluir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>

    ;(function($) 
    {
        'use strict';
        $(document).ready(function()
        {
            var $fileupload = $('#fileupload');
            $fileupload.fileupload({
                url: '/upload',
                dataType: 'json',
                formData: {_token: $fileupload.data('token'), userId: $fileupload.data('userId')},
                done: function (e, data) {
                    window.location.reload();
                },
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css(
                        'width', 
                        progress + '%'
                    );
                },
            });
        });
    })(window.jQuery);

</script>
@stop