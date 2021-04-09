@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
            <form>
            <select name="allMoney">
                <option value="default" selected disabled>請選擇項目</option>
                <optgroup label="收入">
                    <option value="money">薪水</option>
                    <option value="otherMoney">被動收入</option>
                </optgroup>
                <optgroup label="支出">
                    <option value="eat">餐費</option>
                    <option value="traffic">交通</option>
                    <option value="enterment">娛樂</option>
                    <option value="something">生活用品</option>
                </optgroup>
            </form>
        </div>
    </div>
</div>
@endsection
