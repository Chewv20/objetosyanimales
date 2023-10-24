const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
let cuentasObjetos = []
let cuentasAnimales = []
let cuentasAccidentados = []
let cuentasPersonas = []
let cuentasIncidentes = []
let cuentasPuertas = []
let estaciones = []
let lineas = ['01','02','03','04','05','06','07','08','09','12','LA','LB'];

    $(document).ready(function(){
        iniciaEstadisticas()
        document.getElementById('filtro').addEventListener('click',(e)=>{
            actualizaEstadisticas()
        })
               
    })
    
function iniciaEstadisticas(){
    fetch('/estadisticas/getall/',{
        method : 'POST',
        body: JSON.stringify({   
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{      
        document.getElementById('numObjetos').innerHTML= data.total[0]
        document.getElementById('numAnimales').innerHTML= data.total[1]
        document.getElementById('numAccidentados').innerHTML= data.total[2]
        document.getElementById('numPersonasAjenas').innerHTML= data.total[3]
        document.getElementById('numIncidentes').innerHTML= data.total[4]
        document.getElementById('numPuertas').innerHTML= data.total[5]
        document.getElementById('numZapatas').innerHTML= data.total[6]
        document.getElementById('total').innerHTML= data.total[7]
        cuentasObjetos = data.objetos
        cuentasAnimales = data.animales
        cuentasAccidentados = data.accidentados
        cuentasPersonas = data.personas
        cuentasIncidentes = data.incidentes
        cuentasPuertas = data.puertas
        obtieneEstaciones()
    }).catch(error => console.error(error));
    

}

function actualizaEstadisticas(Pdata){
    fetch('/estadisticas/getcuentas/',{
        method : 'POST',
        body: JSON.stringify({
            fecha :  document.getElementById('fecha').value,
            fecha2 : document.getElementById('fecha2').value,     
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{      
        document.getElementById('numObjetos').innerHTML= data[0]
        document.getElementById('numAnimales').innerHTML= data[1]
        document.getElementById('numAccidentados').innerHTML= data[2]
        document.getElementById('numPersonasAjenas').innerHTML= data[3]
        document.getElementById('numIncidentes').innerHTML= data[4]
        document.getElementById('numPuertas').innerHTML= data[5]
        document.getElementById('numZapatas').innerHTML= data[6]
        document.getElementById('total').innerHTML= data[7]
    }).catch(error => console.error(error));
    
    setTimeout(actualizaEstadisticas,5000)
}

function obtieneEstaciones(){
    fetch('/estacionessi/get/',{
        method : 'POST',
        body: JSON.stringify({   
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{      
        estaciones = data
        creaMapa()
    }).catch(error => console.error(error));
}

function creaMapa(){
    var LeafIcon = L.Icon.extend({
        options: {
            iconSize:     [15, 15],
            iconAnchor:   [0, 0],
            popupAnchor:  [8, 10]
        }
    })
    
    var icon1 = new LeafIcon({iconUrl: '../img/1_circle.png'})
    var icon2 = new LeafIcon({iconUrl: '../img/2_circle.png'})
    var icon3 = new LeafIcon({iconUrl: '../img/3_circle.png'})
    var icon4 = new LeafIcon({iconUrl: '../img/4_circle.png'})
    var icon5 = new LeafIcon({iconUrl: '../img/5_circle.png'})
    var icon6 = new LeafIcon({iconUrl: '../img/6_circle.png'})
    var icon7 = new LeafIcon({iconUrl: '../img/7_circle.png'})
    var icon8 = new LeafIcon({iconUrl: '../img/8_circle.png'})
    var icon9 = new LeafIcon({iconUrl: '../img/9_circle.png'})
    var icon12 = new LeafIcon({iconUrl: '../img/12_circle.png'})
    var icona = new LeafIcon({iconUrl: '../img/a_circle.png'})
    var iconb = new LeafIcon({iconUrl: '../img/b_circle.png'})
    
    
    var map = L.map('map').setView([19.4007336,-99.1236127], 11)
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    estaciones.forEach(element => {
        if (element.linea=='01') {
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icon1},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='02'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icon2},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='03'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icon3},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='04'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icon4},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='05'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icon5},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='06'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icon6},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='07'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icon7},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='08'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icon8},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='09'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icon9},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='12'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icon12},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='La'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:icona},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
        else if(element.linea=='LB'){
            let descripcion = '<b>'+element.estacion+'</b><br>'
            descripcion+= 'Objetos en vías: '+cuentasObjetos[element.id_estacion]+'<br>'
            descripcion+= 'Animales en vías: '+cuentasAnimales[element.id_estacion]+'<br>'
            descripcion+= 'Accidentados en vías: '+cuentasAccidentados[element.id_estacion]+'<br>'
            descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[element.id_estacion]+'<br>'
            descripcion+= 'Incidentes Relevantes: '+cuentasIncidentes[element.id_estacion]+'<br>'
            descripcion+= 'Cierre de Puertas: '+cuentasPuertas[element.id_estacion]+'<br>'
            L.marker([element.longitud,element.latitud],{icon:iconb},{draggable: true}).bindPopup(descripcion).addTo(map)
        }
    })
    
}