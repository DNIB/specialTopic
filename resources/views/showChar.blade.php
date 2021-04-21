<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="earnSpend" width="600" height="200"></canvas>
<script>
fetch('/api/charData/{{$id}}')
    .then(response =>{
        return  response.json()//解析成一個json 物件
        console.log(response)
    })// 因為轉成json 物件 也回傳一個promise  出來
    .then( data =>{
        render(data);
})

function render(data){
    let allspend = data['allspend'];
    let allearn = data['allearn'];
    const labels = [ "總支出", "總收入"];
    
    var ctx = document.getElementById( "earnSpend" ),
        earnSpend = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                
                datasets: [{
                    label: "收支表",
                    data: [ allspend, allearn ],
                    backgroundColor: [ 
                    "#FF0000",
                    "#00FF00",
                    ],
                    borderWidth: 1,
                }]
                
            }
    });
        
}
</script>

<style>
canvas{
    width:800px !important;
    height:500px !important;
}
</style>

