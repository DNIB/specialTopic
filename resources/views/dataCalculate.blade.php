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
            <table style="border:3px #cccccc solid;" cellpadding="20" border='1'>
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
            <div style="width: 400px; height: 230px">
                <canvas id="earnSpend"></canvas>
            </div>
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
            <div style="width: 350px; height: 350px">
                <canvas id="itemsAllSpend"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let datas = null;
function init()
{
    fetch('/api/charData/{{ $user_id }}?api_token={{ Auth::user()->api_token }}')
    .then(response =>{
        return response.json()//解析成一個json 物件
    console.log(response)
    })// 因為轉成json 物件 也回傳一個promise  出來
    .then( result =>{
        datas = result;
        initEarnSpend();
        inititemsAllSpend();
    })
}
function initEarnSpend()
{
    let allspend = datas['allspend'];
    let allearn = datas['allearn'];
    const labels = [ "總支出", "總收入"];
    var ctx = document.getElementById( "earnSpend" ).getContext('2d');
    var data = [{
        label: "收支表",
        data: [ allspend, allearn ],
        backgroundColor: [ 
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
        ],
        borderWidth: 1
    }];
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: data,
        },
    });
}
function inititemsAllSpend(){
    let eat = datas['eat'];
    let traffic = datas['traffic'];
    let play = datas['play'];
    let otherspend = datas['otherspend'];
    const labels = [ "餐費", "交通", "娛樂", "其他花費"];
    var ctx = document.getElementById('itemsAllSpend').getContext('2d');
    var data = [{
        label: "收支表",
        data: [ eat, traffic, play, otherspend ],
        backgroundColor: [ 
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(125, 205, 46)',
        ],
        borderWidth: 1
    }]
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: data,
        },
    });
}
</script>