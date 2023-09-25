@extends('adminlte::page')

@section('title', 'Anexo III')
<link rel="icon" href="{{ URL::asset('img/logo.png') }}" />

@section('content_header')
    <h1 class="m-0 text-dark">Número de Vueltas</h1>
    <link rel="stylesheet" href="{{ URL::asset('css/anexoii.css') }}" />
@stop

@php
use App\Http\Controllers\AnexoIIIController;
    $hoy = date("Y-m-d");
@endphp

@section('content')

    <p id='fechaHoy'></p>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="col-8 col-md-5 ">
                            <div class="input-group input-group-sm mb-3">
                               <div class="input-group-prepend d-none d-md-block">
                                  <span class="input-group-text" id="inputGroup-sizing-sm">Ver Gráficas del día</span>
                               </div>
                               <input type="date" id="fecha" class="form-control" name="fecha_inicial" value="<?php echo $hoy;?>" min="2020-11-04" max="<?php echo $hoy;?>">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-check">
                                <input class="festivo-check-input" type="checkbox" value="0" id="festivo">
                                <label class="festivo-check-label" for="defaultCheckPV"> Día Festivo </label>
                             </div>
                        </div>
                        <?php
                        $lineas = ['01','02','03','04','05','06','07','08','09','12','LA','LB'];
                        foreach( $lineas as $linea){ 
                        ?>
                        <div class="col-5">
                            <canvas id="graficaLinea<?php echo $linea; ?>"></canvas>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ URL::asset('js/anexoiii.js') }}"></script>


<script>
    let graficaLinea1
    let graficaLinea2
    let graficaLinea3
    let graficaLinea4
    let graficaLinea5
    let graficaLinea6
    let graficaLinea7
    let graficaLinea8
    let graficaLinea9
    let graficaLinea12
    let graficaLineaA
    let graficaLineaB
    let vueltas = []
    let vueltasP = []
    let lineas = ['01','02','03','04','05','06','07','08','09','12','LA','LB']
    let fecha
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    $(document).ready(function(){
        fecha = new Date(document.getElementById('fecha').value)
        fecha.setTime(fecha.getTime() + fecha.getTimezoneOffset() * 60 * 1000);
        obtieneVueltas(0)

        document.getElementById('fecha').addEventListener('change',(e)=>{
            //console.log(e.target.value);
            destruyeGraficas()
            fecha = new Date(document.getElementById('fecha').value)
            fecha.setTime(fecha.getTime() + fecha.getTimezoneOffset() * 60 * 1000);
            obtieneVueltas(0)
        })

        document.getElementById('festivo').addEventListener('change',(e)=>{
            if(document.querySelector('.festivo-check-input').checked){
                destruyeGraficas()
                fecha = new Date(document.getElementById('fecha').value)
                fecha.setTime(fecha.getTime() + fecha.getTimezoneOffset() * 60 * 1000);
                obtieneVueltas(1)
            }else{
                destruyeGraficas()
                fecha = new Date(document.getElementById('fecha').value)
                fecha.setTime(fecha.getTime() + fecha.getTimezoneOffset() * 60 * 1000);
                obtieneVueltas(0)
            }
        })

        
})

function obtieneVueltas(festivo)
{
    
    fetch('/anexoIII/get',{
        method : 'POST',
        body: JSON.stringify({
            fecha : document.getElementById('fecha').value    
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{      
        
        lineas.forEach(element => {
            vueltas[element] = 0
        })
        lineas.forEach(element=>{
            data.forEach(item => {
                if(element==item.linea){
                    vueltas[element]-=parseFloat(item.vueltas)
                    vueltas[element]+=parseFloat(item.vueltas_realizadas)
                }
            })
        })

        obtieneVueltasP(fecha.getDay(),festivo)
    }).catch(error => console.error(error));

}

function obtieneVueltasP(Pid, Pfestivo)
{
    fetch('/anexoIII/getvueltas',{
        method : 'POST',
        body: JSON.stringify({
            id : Pid,
            festivo : Pfestivo    
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{      
        
        lineas.forEach(element => {
            vueltasP[element] = 0
        })
        lineas.forEach(element=>{
            data.forEach(item => {
                if(element==item.linea){
                    vueltasP[element]=parseFloat(item.vueltas)
    
                }
            })
        })

        generaGraficas()
    }).catch(error => console.error(error));
}

function generaGraficas()
{
    generaGrafica1('graficaLinea01',vueltasP['01'],vueltasP['01']+vueltas['01'])
    generaGrafica2('graficaLinea02',vueltasP['02'],vueltasP['02']+vueltas['02'])
    generaGrafica3('graficaLinea03',vueltasP['03'],vueltasP['03']+vueltas['03'])
    generaGrafica4('graficaLinea04',vueltasP['04'],vueltasP['04']+vueltas['04'])
    generaGrafica5('graficaLinea05',vueltasP['05'],vueltasP['05']+vueltas['05'])
    generaGrafica6('graficaLinea06',vueltasP['06'],vueltasP['06']+vueltas['06'])
    generaGrafica7('graficaLinea07',vueltasP['07'],vueltasP['07']+vueltas['07'])
    generaGrafica8('graficaLinea08',vueltasP['08'],vueltasP['08']+vueltas['08'])
    generaGrafica9('graficaLinea09',vueltasP['09'],vueltasP['09']+vueltas['09'])
    generaGrafica12('graficaLinea12',vueltasP['12'],vueltasP['12']+vueltas['12'])
    generaGraficaA('graficaLineaLA',vueltasP['LA'],vueltasP['LA']+vueltas['LA'])
    generaGraficaB('graficaLineaLB',vueltasP['LB'],vueltasP['LB']+vueltas['LB'])

}

function generaGrafica1(id,programadas,realizadas)
{
    
    graficaLinea1 = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
            'rgba(240, 78, 152)',
            'rgba(240, 78, 152)'
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgba(240, 78, 152)'
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea 1'
                }
            }
        }
        });
}

function generaGrafica2(id,programadas,realizadas)
{
    
    graficaLinea2 = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
                'rgba(0,94,184)',
                'rgba(0,94,184)'
            ],
            borderColor: [
                'rgba(0,94,184)',
                'rgba(0,94,184)'
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea 2'
                }
            }
        }
        });
}

function generaGrafica3(id,programadas,realizadas)
{
    
    graficaLinea3 = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
                'rgba(175, 152, 0)',
                'rgba(175, 152, 0)',            
            ],
            borderColor: [
                'rgba(175, 152, 0)',
                'rgba(175, 152, 0)',

            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea 3'
                }
            }
        }
        });
}

function generaGrafica4(id,programadas,realizadas)
{
    
    graficaLinea4 = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
            'rgba(107, 187, 174)',
            'rgba(107, 187, 174)',
            
            ],
            borderColor: [
            'rgb(107, 187, 174)',
            'rgb(107, 187, 174)',
            
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea 4'
                }
            }
        }
        });
}

function generaGrafica5(id,programadas,realizadas)
{
    
    graficaLinea5 = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
            'rgba(255, 209, 0)',
            'rgba(255, 209, 0)',
            
            ],
            borderColor: [
                'rgba(255, 209, 0)',
                'rgba(255, 209, 0)',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea 5'
                }
            }
        }
        });
}

function generaGrafica6(id,programadas,realizadas)
{
    
    graficaLinea6 = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
            'rgba(218, 41, 28)',
            'rgba(218, 41, 28)',
            
            
            ],
            borderColor: [
                'rgba(218, 41, 28)',
                'rgba(218, 41, 28)',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea 6'
                }
            }
        }
        });
}

function generaGrafica7(id,programadas,realizadas)
{
    
    graficaLinea7 = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
                'rgba(232, 119, 34)',
                'rgba(232, 119, 34)',
            
            ],
            borderColor: [
                'rgba(232, 119, 34)',
                'rgba(232, 119, 34)',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea 7'
                }
            }
        }
        });
}

function generaGrafica8(id,programadas,realizadas)
{
    
    graficaLinea8 = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
            'rgba(0, 154, 68)',
            'rgba(0, 154, 68)',
            
            ],
            borderColor: [
                'rgba(0, 154, 68)',
            'rgba(0, 154, 68)',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea 8'
                }
            }
        }
        });
}

function generaGrafica9(id,programadas,realizadas)
{
    
    graficaLinea9 = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
            'rgba(81, 47, 46)',
            'rgba(81, 47, 46)',
            
            ],
            borderColor: [
                'rgba(81, 47, 46)',
                'rgba(81, 47, 46)',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea 9'
                }
            }
        }
        });
}

function generaGrafica12(id,programadas,realizadas)
{
    
    graficaLinea12 = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
            'rgba(192, 155, 87)',
            'rgba(192, 155, 87)',
            
            ],
            borderColor: [
                'rgba(192, 155, 87)',
                'rgba(192, 155, 87)',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea 12'
                }
            }
        }
        });
}

function generaGraficaA(id,programadas,realizadas)
{
    
    graficaLineaA = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
            'rgba(152, 29, 151)',
            'rgba(152, 29, 151)',
            
            ],
            borderColor: [
                'rgba(152, 29, 151)',
            'rgba(152, 29, 151)',
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea A'
                }
            }
        }
        });
}

function generaGraficaB(id,programadas,realizadas)
{
    
    graficaLineaB = new Chart(id, {
        type: 'bar',
        data: {
            labels: ['Programadas', 'Realizadas'],
            datasets: [{
            label: '# de vueltas',
            data: [programadas,realizadas],
            backgroundColor: [
            'rgb(0, 132, 61)',
            'rgb(177,179,179)'
            
            ],
            borderColor: [
                'rgb(0, 132, 61)',
                'rgb(177,179,179)'
            ],
            borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Vueltas Línea B'
                }
            }
        }
        });
}

function destruyeGraficas()
{
    graficaLinea1.destroy()
    graficaLinea2.destroy()
    graficaLinea3.destroy()
    graficaLinea4.destroy()
    graficaLinea5.destroy()
    graficaLinea6.destroy()
    graficaLinea7.destroy()
    graficaLinea8.destroy()
    graficaLinea9.destroy()
    graficaLinea12.destroy()
    graficaLineaA.destroy()
    graficaLineaB.destroy()
}


</script>

@stop