@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">登入首頁</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p>登入成功</p>
                    <p>您的名字是: {{ $name }}</p>
                    <p>您的email是: {{ $email }}</p>

                    @can('admin')
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td> 姓名</td>
                                <td> 信箱</td>
                                <td colspan="2">修改資料</td>
                            <tr>
                        </thead>
                        <tbody>
                            @foreach($userdata as $case)
                            <tr>
                                <td>{{$case->name}}</td>
                                <td>{{$case->email}}</td>
                                <td><a href="{{ route('userself.edit', $case->id)}}" class="btn btn-primary">Edit</a></td>
                                <td>
                                    <form action="{{ route('userself.destroy', $case->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endcan
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
