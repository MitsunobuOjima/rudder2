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
                        {{Form::submit('選択', ['class'=>'btn btn-primary btn-block btn_100x'])}}
                    </form>
                </div>

                @if(!empty($arrBrandData))
                <div class="" style="">
                    <form id="edit_brand_data" method="POST" action="/ctrl_brand/edit">
                        @csrf
                        @foreach($arrBrandData as $key => $val)
                        <div class="margin: 20px 0;">
                            {{ Form::hidden('id', old('id', $val->id), ['class' => 'form-control']) }}
                            <p>ブランド名：{{ Form::text('name', old('name', $val->name), ['class' => 'form-control hoge_200x']) }}</p>
                            <p>略称：{{ Form::text('code', old('code', $val->code), ['class' => 'form-control hoge_150x']) }}</p>
                            <p>担当チーム：{{ Form::text('team', old('team', $val->team), ['class' => 'form-control hoge_150x']) }} チーム</p>
{{--
                            係数：{{ Form::text('coefficient', old('coefficient', $val->coefficient), ['class' => 'form-control hoge_10']) }}</p>
--}}
                            <p>期首開始月：{{ Form::text('fiscal_start_month', old('fiscal_start_month', $val->fiscal_start_month), ['class' => 'form-control hoge_150x']) }} 月</p>
                        </div>
                        @endforeach
                        {{Form::submit('編集', ['class'=>'btn btn-primary btn-block btn_100x'])}}
                    </form>
                </div>
                @endif

                <hr />
                <h4>予算管理</h4>

                <div class="" style="">
                    <form id="edit_budget_year" method="POST" action="/ctrl_brand/select_year">
                        @csrf
                        {{ Form::hidden('id', old('id', $brand_id), ['class' => 'form-control']) }}
                        {{ Form::hidden('brand_id', old('brand_id', $brand_id), ['class' => 'form-control']) }}
                        {{ Form::hidden('select_brand', old('brand_id', $brand_id), ['class' => 'form-control']) }}
                        <div class="margin: 20px 0;">
                          <select name="selected_year">
                              <option value="2021">2021</option>
                              <option value="2022">2022</option>
                          </select>
                        </div>
                        {{Form::submit('表示', ['class'=>'btn btn-primary btn-block btn_100x'])}}
                    </form>

                    <form id="edit_budget" method="POST" action="/ctrl_brand/edit_budget">
                        @csrf
                        {{ Form::hidden('selected_year', old('selected_year', $selected_year), ['class' => 'form-control']) }}
                        {{ Form::hidden('select_brand', old('brand_id', $brand_id), ['class' => 'form-control']) }}
                        <p>年度予算：{{ Form::text('brand_budget_year', old('brand_budget_year', $brand_budget_year), ['class' => 'form-control hoge_200x']) }} 円</p>
                        @foreach($arrBudget as $key2 => $val2)
                        <div class="margin: 20px 0;">
                            <p class="bobo">{{$val2->month}}月：{{ Form::text('brand_budget_month' . $val2->month, old('brand_budget_month', $val2->brand_budget_month), ['class' => 'form-control hoge_150x']) }} 円</p>
                        </div>
                        @endforeach
                        {{Form::submit('編集', ['class'=>'btn btn-primary btn-block btn_100x'])}}
                    </form>
                </div>

@stop

@section('css')
<style>
.hoge_50p {
    display: inline;
    width: 50%;
    margin: 5px 0;
}
.hoge_20p {
    display: inline;
    width: 20%;
}
.hoge_200x {
    display: inline;
    width: 200px;
    margin: 5px 0;
}
.hoge_150x {
    display: inline;
    width: 150px;
    margin: 5px 0;
}
.btn_100x {
    display: inline;
    width: 100px !important;
    margin: 5px 0;
}
</style>
@stop

@section('js')
    <script> console.log('ページごとJSの記述'); </script>
@stop
