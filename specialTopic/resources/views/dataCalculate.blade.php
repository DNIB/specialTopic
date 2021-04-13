@extends('layouts.app')

@section('content')



@if ($finalmoney < 0) 
    <script>
        alert('no money!!!!!!!!!!!!');
    </script>
@endif


<div>
    
    <p>總收入 {{ $allearn }}</p>
    <p>總支出 {{ $allspend }}</p>
    <p>餐費 {{ $eat }}</p>
    <p>交通 {{ $traffic }}</p>
    <p>娛樂 {{ $play }}</p>
    <p>其他支出 {{ $otherspend }}</p>
    <p>薪水 {{ $salary }}</p>
    <p>其他收入 {{ $otherearn }}</p>
    <p>餘額 {{ $finalmoney }}</p>
        <p>{{ $test }}</p>
        @foreach($data as $datas)
        <p>{{ $datas }}</p>
        @endforeach
    
</div>

@endsection
