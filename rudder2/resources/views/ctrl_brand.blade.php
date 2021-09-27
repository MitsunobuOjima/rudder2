@extends('adminlte::page')

@section('title', 'ブランド管理')

@section('content_header')
    <h1>ブランド管理</h1>
@stop

@section('content')
                <div class="" style="">
                    <form id="disp_brand_data" method="POST" action="">
                        @csrf
                        <div class="margin: 20px 0;">
                          <select name="select_brand">
                            @foreach($brand_list as $id => $name)
                              <option value="{{ $name->id }}">{{ $name->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        {{Form::submit('選択', ['class'=>'btn btn-primary btn-block'])}}
                    </form>
                </div>

                @if(!empty($arrBrandData))
                <div class="" style="">
                    <form id="edit_brand_data" method="POST" action="/ctrl_brand/edit">
                        @csrf
                        @foreach($arrBrandData as $key => $val)
                        <div class="margin: 20px 0;">
                            {{ Form::hidden('id', old('id', $val->id), ['class' => 'form-control']) }}
                            ブランド名：{{ Form::text('name', old('name', $val->name), ['class' => 'form-control']) }}
                            略称：{{ Form::text('code', old('code', $val->code), ['class' => 'form-control']) }}
                            担当チーム：{{ Form::text('team', old('team', $val->team), ['class' => 'form-control']) }}チーム
                            係数：{{ Form::text('coefficient', old('coefficient', $val->coefficient), ['class' => 'form-control']) }}
                            期首開始月：{{ Form::text('fiscal_start_month', old('fiscal_start_month', $val->fiscal_start_month), ['class' => 'form-control']) }}月
                        </div>
                        @endforeach
                        {{Form::submit('編集', ['class'=>'btn btn-primary btn-block'])}}
                    </form>
                </div>
                @endif
@stop

@section('css')

@stop

@section('js')
    <script> console.log('ページごとJSの記述'); </script>
@stop
