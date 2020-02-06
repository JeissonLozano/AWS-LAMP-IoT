// Grafica 1
function datos(){
    var datos = [],
    tiempo = (new Date()).getTime(), i;
    for( i = -10; i <= 0; i += 1){
        datos.push({
            x: tiempo + i * 1000,
            y: Math.random()*50
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
            fill: false,          
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
                type: 'time',
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


Chart.scaleService.updateScaleDefaults('linear', {
    ticks: {
        min: 0
    }
});



var ctx = document.getElementById('grafica1').getContext('2d');
var grafica1 = new Chart(ctx, config);


function update() {        
        var time = (new Date()).getTime();
        config.data.datasets.forEach(function(dataset) {
            dataset.data.shift();
            dataset.data.push({x: time ,y: Math.random()*50});
        });
        grafica1.update();
    }

setInterval(update, 4000);

// Fin Grafica 1

// Grafica 2

var config2 = {
    type: 'line',
    data: {
        datasets: [{
            label: 'Temperatura',
            backgroundColor: 'rgb(54, 162, 235)',
            borderColor: 'rgb(54, 162, 235)',
            data: datos(0),
            fill: false,          
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
            yaxis : [{
                min : 0,
                max : 100,
                show: true
              }]            
        }
    }
};

var ctx2 = document.getElementById('grafica2').getContext('2d');
var grafica2 = new Chart(ctx2, config2);

// Fin Grafica 2