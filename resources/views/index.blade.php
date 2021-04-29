@extends('layouts.app')
@section('content')
<style>
    .uper {
        margin-top: 40px;
    }
</style>

<script src="https://leewannacott.github.io/table-sort-js/table-sort.js"></script>

<div>
    <form method="post" action="{{ route('Userinput.showSearchItem') }}">
        @csrf
        <select name="searchItem">
            <option value="0" disabled selected>請選擇搜尋項目</option>
            <option value="1">餐費</option>
            <option value="2">交通</option>
            <option value="3">娛樂</option>
            <option value="4">其他支出</option>
            <option value="5">薪水</option>
            <option value="6">其他收入</option>
        </select>
        @can('admin')
        <input type="number" name="searchUser">
        @endcan
        <button type="submit">搜尋</button>
    </form>
</div>
<div class="uper">
    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div><br />
    @endif
    {{-- <table class="table table-striped"> --}}
    <table class="table-sort table table-striped">
        <thead>
            <tr>
                @can('admin')
                <th>id</th>
                <th>userID ↕</th>
                <th>userName</th>
                @endcan
                <th>支出項目</th>
                <th>金額 ↕</th>
                <th>備註</th>
                <th>創建時間 ↕</th>
                <th>更新時間 ↕</th>
                <th colspan="2">修改資料</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userinput as $case)
            @if($case->itemID<5) <tr>
                @can('admin')
                <td>{{ $case->id }}</td>
                <td>{{ $case->userID }}</td>
                <td>{{ $case->userSelfData->name }}</td>
                @endcan
                <td>{{$case->items->item}}</td>
                <td>{{$case->money}}</td>
                <td>{{$case->describe}}</td>
                <td>{{$case->created_at}}</td>
                <td>{{$case->updated_at}}</td>
                <td><a href="{{ route('Userinput.edit', $case->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{ route('Userinput.destroy', $case->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
                </tr>
                @endif
                @endforeach
        </tbody>
    </table>
    <hr>

    {{-- <table class="table table-striped"> --}}
    <table class="table-sort table table-striped">
        <thead>
            <tr>
                @can('admin')
                <th>id</th>
                <th>userID ↕</th>
                <th>userName</th>
                @endcan
                <th>收入項目</th>
                <th>金額 ↕</th>
                <th>備註</th>
                <th>創建時間 ↕</th>
                <th>更新時間 ↕</th>
                <th colspan="2">修改資料</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userinput as $case)
            @if($case->itemID>4)
            <tr>
                @can('admin')
                <td>{{ $case->id }}</td>
                <td>{{ $case->userID }}</td>
                <td>{{ $case->userSelfData->name }}</td>
                @endcan
                <td>{{$case->items->item}}</td>
                <td>{{$case->money}}</td>
                <td>{{$case->describe}}</td>
                <td>{{$case->created_at}}</td>
                <td>{{$case->updated_at}}</td>
                <td><a href="{{ route('Userinput.edit', $case->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{ route('Userinput.destroy', $case->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    <div>

        @endsection
