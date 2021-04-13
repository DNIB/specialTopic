@extends('layout')
@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="card uper">
    <div class="card-header">
        Edit Corona Virus Data
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        <form method="post" action="{{ route('Userinput.update', $editData->id) }}">
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label>備註 :</label>
                <input type="text" class="form-control" name="describe" value="{{ $editData->describe }}"/>
            </div>
            <div class="form-group">
                <label>選項 :</label>
                <p><input type="radio" name="itemID" value="1" {{ $editData->itemID == 1 ? 'checked' : ''}}> 餐費</p>
                <p><input type="radio" name="itemID" value="2" {{ $editData->itemID == 2 ? 'checked' : ''}}> 交通</p>
                <p><input type="radio" name="itemID" value="3" {{ $editData->itemID == 3 ? 'checked' : ''}}> 娛樂</p>
                <p><input type="radio" name="itemID" value="4" {{ $editData->itemID == 4 ? 'checked' : ''}}> 其他支出</p>
                <p><input type="radio" name="itemID" value="5" {{ $editData->itemID == 5 ? 'checked' : ''}}> 薪水</p>
                <p><input type="radio" name="itemID" value="6" {{ $editData->itemID == 6 ? 'checked' : ''}}> 其他收入</p>
            </div>
            <div class="form-group">
                <label for="cases">金額 :</label>
                <input type="number" class="form-control" name="money" value="{{ $editData->money }}"/>
            </div>
            <button type="submit" class="btn btn-primary">Update Data</button>
        </form>
    </div>
</div>
@endsection
