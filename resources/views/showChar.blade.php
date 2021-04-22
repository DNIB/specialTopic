<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div style="width: 400px; height: 230px">
    <canvas id="earnSpend"></canvas>
</div>

<script>
fetch('/api/charData/{{ $id }}')
    .then(response =>{
        return  response.json()//解析成一個json 物件
        console.log(response)
    })// 因為轉成json 物件 也回傳一個promise  出來
    .then( data =>{
        renderBar(data);
})

function renderBar(data){
    let allspend = data['allspend'];
    let allearn = data['allearn'];
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
    }]

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: data,
        },
    });
        
}
</script>

