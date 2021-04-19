<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="itemsAllSpend" width="600" height="600"></canvas>
<script>
fetch('http://localhost/api/charData/{{$id}}')
    .then(response =>{
        return  response.json()//解析成一個json 物件
        console.log(response)
    })// 因為轉成json 物件 也回傳一個promise  出來
    .then( data =>{
        render(data);
})

function render(data){
    let eat = data['eat'];
    let traffic = data['traffic'];
    let play = data['play'];
    let otherspend = data['otherspend'];
    const labels = [ "餐費", "交通", "娛樂", "其他花費"];
    var ctx = document.getElementById( "itemsAllSpend" ),
        itemsAllSpend = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: labels,
                datasets: [{
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
            }
        });
}
</script>

<style>
canvas{
    width:700px !important;
    height:700px !important;
}
</style>

