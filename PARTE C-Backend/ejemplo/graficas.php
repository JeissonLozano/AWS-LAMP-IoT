<script>
// Inicio Grafica 1
function datos(){
    var datos = [],
    tiempo = (new Date()).getTime(), i;
    for( i = -8; i <= 0; i += 1){
        datos.push({
            x: tiempo + i * 1000,
            y: -1
        });
    }
    return datos;
}


var config = {
    type: 'line',
    data: {
        datasets: [{
            label: 'Temperatura',
            backgroundColor: 'rgb(54, 162, 235)',
            borderColor: 'rgb(54, 162, 235)',
            data: datos(0),
            fill: false
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Temperatura en Real Time'
        },
        scales: {
            xAxes: [{
                type: 'time'                
            }],
            yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true,
                    steps: 10,
                    stepValue: 5,
                    max: 50
                }
            }]            
        }
    }
};

var ctx = document.getElementById('grafica1').getContext('2d');

var grafica1 = new Chart(ctx, config);

function update() {        
    var time = (new Date()).getTime();
    config.data.datasets.forEach(function(dataset) {
        dataset.data.shift();
        dataset.data.push({x: time ,y: ValorTemperatura});
    });
    grafica1.update();
}
setInterval(update, 4000);


// Fin gráfica 1

// Inicio Grafica 2

var config2 = {
    type: 'line',
    data: {
        datasets: [{
            label: 'Temperatura',
            backgroundColor: 'rgb(54, 162, 235)',
            borderColor: 'rgb(54, 162, 235)',
            data: [
                <?php     
                while ($Respuesta=mysqli_fetch_array($consulta)) {
                echo "{ x: '";
                echo ($Respuesta[0]); 
                echo "', y: '";
                echo $Respuesta[1]; 
                echo "'},";
                }
                $consulta->close();
                ?>
        ],
            fill: false
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Histograma de temperatura'
        },
        scales: {
            xAxes: [{
                type: 'time'                
            }],
            yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true,
                    steps: 10,
                    stepValue: 5,
                    max: 50
                }
            }]            
        }
    }
};

var ctx2 = document.getElementById('grafica2').getContext('2d');

var grafica2 = new Chart(ctx2, config2);
// Fin gráfica 2
</script>