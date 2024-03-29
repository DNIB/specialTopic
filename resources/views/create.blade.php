@extends('layouts.app')
@section('content')
<style>
.uper {
    margin-top: 40px;
}
</style>
<div class="container">
    <div class="card uper">
        @if(session()->get('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @elseif(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        
        <div class="card-header">
            <p>請輸入資料</p>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('Userinput.store') }}">
                @csrf
                <div class="form-group">
                    <label>支出 :</label>
                    @foreach ( $cost_items as $cost_item )
                        <p><input type="radio" name="itemID" value="{{ $cost_item->id }}" required/> {{ $cost_item->item }}</p>
                    @endforeach

                    <label>收入 :</label>
                    @foreach ( $earn_items as $earn_item )
                        <p><input type="radio" name="itemID" value="{{ $earn_item->id }}" required/> {{ $earn_item->item }}</p>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="money">金額 :</label>
                    <input class="form-control" type="number" name="money" min=1 max=999999 required/>
                </div>
            
                <div class="form-group">
                    <label for="describe">備註:</label>
                    <textarea class="form-control" id="describe" name="describe" rows="3" placeholder="備註"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">新增資料</button>
            </form>
        </div>
    </div>
</div>
@endsection