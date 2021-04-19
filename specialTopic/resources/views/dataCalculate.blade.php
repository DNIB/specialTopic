@extends('layouts.app')

@section('content')

@if ($finalmoney < 0) 
    <script>
        alert('餘額不足！！！');
    </script>
@endif

<div>
    <table style="border:3px #cccccc solid;" cellpadding="20" border = '1' >
        <caption>收入表</caption>
        <tr>
            <th>項目</th>
            <th>金額</th>
            <th>總收入</th>
        </tr>
        <tr>
            <td>薪水</td>
            <td>{{ $salary }}</td>
            <td rowspan="2">{{ $allearn }}</td>
        </tr>
        <tr>
            <td>其他收入</td>
            <td>{{ $otherearn }}</td>
        </tr>
    </table>
</div>

<div>
    <table style="border:3px #cccccc solid;" cellpadding="20" border='1'>
        <caption>支出表</caption>
        <tr>
            <th>項目</th>
            <th>金額</th>
            <th>總支出</th>
        </tr>
        <tr>
            <td>餐費</td>
            <td>{{ $eat }}</td>
            <td rowspan="4">{{ $allspend }}</td>
        </tr>
        <tr>
            <td>交通</td>
            <td>{{ $traffic }}</td>
        </tr>
        <tr>
            <td>娛樂</td>
            <td>{{ $play }}</td>
        </tr>
        <tr>
            <td>其他支出</td>
            <td>{{ $otherspend }}</td>
        </tr>
    </table>
</div>

<form method='get' action="/showSpendChar/">
    <button type="submit" class="btn btn-primary">花費圓餅圖</button>
</form>

<p style="color:red">餘額 {{ $finalmoney }}</p>

<form method='get' action="/showChar/">
    <button type="submit" class="btn btn-primary">收支長條圖</button>
</form>



@endsection
