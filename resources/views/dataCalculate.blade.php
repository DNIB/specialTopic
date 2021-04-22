@extends('layouts.app')

@section('content')
<?php $user_id = Auth::user()->id; ?>
<div class="container">

    @if ($finalmoney < 0) 
        <script>
            alert('餘額不足！！！');
        </script>
    @endif

    <div>
        <h2>收入表</h2>
        <div class="row">
            <table style="border:3px #cccccc solid;" cellpadding="20" border = '1' >
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
            @component ('showChar')
                @slot('id')
                    {{ $user_id }}
                @endslot
            @endcomponent
        </div>
    </div>

    <div>
        <h2>支出表</h2>
        <div class="row">    
            <div>
                <table style="border:3px #cccccc solid;" cellpadding="20" border='1'>
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
                <span style="color:red">餘額 {{ $finalmoney }}</span>
            </div>
            @component ('showSpendChar')
                @slot('id')
                    {{ $user_id }}
                @endslot
            @endcomponent
        </div>
    </div>
</div>
@endsection
