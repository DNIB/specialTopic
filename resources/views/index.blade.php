@extends('layouts.app')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
    @if(session()->get('success'))
        <div class="alert alert-success">
        {{ session()->get('success') }}  
        </div><br />
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                @can('admin')
                <td>id</td>
                <td>userID</td>
                @endcan
                <td>項目</td>
                <td>金額</td>
                <td>備註</td>
                <td>創建時間</td>
                <td>更新時間</td>
                <td colspan="2">修改資料</td>
            </tr>
        </thead>
        <tbody>
            @foreach($userinput as $case)
            <tr>
                @can('admin')
                <td>{{$case->id}}</td>
                <td>{{$case->userID}}</td>
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
            @endforeach
        </tbody>
    </table>
<div>
@endsection