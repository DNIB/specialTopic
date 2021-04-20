@extends('layout')
@section('content')

<style>
    .uper {
        margin-top: 40px;
    }
</style>
<div class="card uper">
    <div class="card-header">
        請修改欲更正之資料
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
        <form method="post" action="{{ route('userself.update', $editData->id) }}">
            <div class="form-group">
                <label>姓名 :</label>
                <input type="text" class="form-control" name="name" value="{{ $editData->name }}"/>
            </div>
            <div class="form-group">
                <label>信箱 :</label>
                <input type="text" class="form-control" name="email" value="{{ $editData->email }}"/>
            </div>
            <div class="form-group">
                @csrf
                @method('PATCH')
                <label>密碼 :</label>
                <input type="text" class="form-control" name="password" value="{{ $editData->password }}"/>
            </div>
            <button type="submit" class="btn btn-primary">Update Data</button>
        </form>
    </div>
</div>
@endsection
