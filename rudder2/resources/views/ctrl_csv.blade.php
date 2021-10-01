@extends('adminlte::page')

@section('title', 'CSV管理')

@section('content_header')
    <h1>CSV管理</h1>
@stop

@section('content')
                <div class="" style="">
                    <form id="exec_read_csv" method="POST" action="/ctrl_csv/import">
                        @csrf
                        <div class="margin: 20px 0;">
                          <select name="select_brand">
{{--
                            @foreach($brand_list as $id => $name)
                              <option value="{{ $name->id }}">{{ $name->name }}</option>
                            @endforeach
--}}
                          </select>
                        </div>
                        {{Form::submit('import', ['class'=>'btn btn-primary btn-block'])}}
                    </form>
                </div>
@stop

@section('css')

@stop

@section('js')
    <script> console.log('ページごとJSの記述'); </script>
@stop
