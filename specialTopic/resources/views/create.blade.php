@extends('layouts.app')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
    <div class="card-header">
        <p>請輸入資料</p>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br/>
        @endif
            <form method="post" action="{{ route('Userinput.store') }}">
                <div class="form-group">
                    @csrf
                    <label>備註:</label>
                    <input type="text" name="describe"/>
                </div>
                <div class="form-group">
                    <label>選項 :</label>
                    <p><input type="radio" name="itemID" value="1"/> 餐費</p>
                    <p><input type="radio" name="itemID" value="2"/> 交通</p>
                    <p><input type="radio" name="itemID" value="3"/> 娛樂</p>
                    <p><input type="radio" name="itemID" value="4"/> 其他支出</p>
                    <p><input type="radio" name="itemID" value="5"/> 薪水</p>
                    <p><input type="radio" name="itemID" value="6"/> 其他收入</p>
                </div>
                <div class="form-group">
                    <label>金額 :</label>
                    <input type="number" name="money", min=1 , max=100000/>
                </div>
                <button type="submit" class="btn btn-primary">新增資料</button>
            </form>
    </div>
</div>
@endsection