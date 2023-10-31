const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
let cuentasObjetos = []
let cuentasAnimales = []
let cuentasArrollados = []
let cuentasAccidentados = []
let cuentasPersonas = []
let cuentasIncidentes = []
let cuentasPuertas = []
let cuentasCables = []
let estaciones = []
let lineas = ['01','02','03','04','05','06','07','08','09','12','LA','LB'];
var map
/* var map = L.map('map').setView([19.4007336,-99.1236127], 11) */

    $(document).ready(function(){
        iniciaEstadisticas()
        document.getElementById('filtro').addEventListener('click',(e)=>{
            fecha1 = document.getElementById('fecha').value
            fecha2 = document.getElementById('fecha2').value
            if(fecha1=='' || fecha2==''){
                Swal.fire({
                    icon: 'error',
                    title: 'Fecha no válida',
                    text: 'Revisa que las dos fechas sean correctas',
                    timer : 500,
                })
            }else{
                map.remove()
                actualizaEstadisticas()
            }
        })

        document.getElementById('borrarFecha').addEventListener('click',(e)=>{
            map.remove()
            iniciaEstadisticas()
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
        document.getElementById('total').innerHTML= data.total[7]
        document.getElementById('numCables').innerHTML= data.total[8]
        document.getElementById('numArrollados').innerHTML= data.total[9]
        cuentasObjetos = data.objetos
        cuentasAnimales = data.animales
        cuentasAccidentados = data.accidentados
        cuentasPersonas = data.personas
        cuentasIncidentes = data.incidentes
        cuentasPuertas = data.puertas
        cuentasCables = data.cables
        cuentasArrollados = data.arrollados
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
        document.getElementById('numObjetos').innerHTML= data.total[0]
        document.getElementById('numAnimales').innerHTML= data.total[1]
        document.getElementById('numAccidentados').innerHTML= data.total[2]
        document.getElementById('numPersonasAjenas').innerHTML= data.total[3]
        document.getElementById('numIncidentes').innerHTML= data.total[4]
        document.getElementById('numPuertas').innerHTML= data.total[5]
        document.getElementById('numZapatas').innerHTML= data.total[6]
        document.getElementById('total').innerHTML= data.total[7]
        document.getElementById('numCables').innerHTML= data.total[8]
        document.getElementById('numArrollados').innerHTML= data.total[9]
        cuentasObjetos = data.objetos
        cuentasAnimales = data.animales
        cuentasAccidentados = data.accidentados
        cuentasPersonas = data.personas
        cuentasIncidentes = data.incidentes
        cuentasPuertas = data.puertas
        cuentasCables = data.cables
        cuentasArrollados = data.arrollados
        obtieneEstaciones()
    }).catch(error => console.error(error));
    
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
    
    var iconObjetos = new LeafIcon({iconUrl: '../img/objetos.png'})
    var iconAnimales = new LeafIcon({iconUrl: '../img/animales.png'})
    var iconAccidentes = new LeafIcon({iconUrl: '../img/accidentados.png'})
    var iconArrollados = new LeafIcon({iconUrl: '../img/accidentados.png'})
    var iconIncidentes = new LeafIcon({iconUrl: '../img/incidentes.png'})
    var iconPersonas = new LeafIcon({iconUrl: '../img/personas.png'})
    var iconPuertas = new LeafIcon({iconUrl: '../img/puertas.png'})
    var iconCables = new LeafIcon({iconUrl: '../img/cables.png'})
    
    var icon1b = new LeafIcon({iconUrl: '../img/1_1_circle.png'})
    var icon2b = new LeafIcon({iconUrl: '../img/2_1_circle.png'})
    var icon3b = new LeafIcon({iconUrl: '../img/3_1_circle.png'})
    var icon4b = new LeafIcon({iconUrl: '../img/4_1_circle.png'})
    var icon5b = new LeafIcon({iconUrl: '../img/5_1_circle.png'})
    var icon6b = new LeafIcon({iconUrl: '../img/6_1_circle.png'})
    var icon7b = new LeafIcon({iconUrl: '../img/7_1_circle.png'})
    var icon8b = new LeafIcon({iconUrl: '../img/8_1_circle.png'})
    var icon9b = new LeafIcon({iconUrl: '../img/9_1_circle.png'})
    var icon12b = new LeafIcon({iconUrl: '../img/12_1_circle.png'})
    var iconab = new LeafIcon({iconUrl: '../img/a_1_circle.png'})
    var iconbb = new LeafIcon({iconUrl: '../img/b_1_circle.png'})

    let icons = new Map()
    let iconsB = new Map()
    icons.set('01',icon1)
    icons.set('02',icon2)
    icons.set('03',icon3)
    icons.set('04',icon4)
    icons.set('05',icon5)
    icons.set('06',icon6)
    icons.set('07',icon7)
    icons.set('08',icon8)
    icons.set('09',icon9)
    icons.set('12',icon12)
    icons.set('LA',icona)
    icons.set('LB',iconb)

    iconsB.set('01',icon1b)
    iconsB.set('02',icon2b)
    iconsB.set('03',icon3b)
    iconsB.set('04',icon4b)
    iconsB.set('05',icon5b)
    iconsB.set('06',icon6b)
    iconsB.set('07',icon7b)
    iconsB.set('08',icon8b)
    iconsB.set('09',icon9b)
    iconsB.set('12',icon12b)
    iconsB.set('LA',iconab)
    iconsB.set('LB',iconbb)
    
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    });
    
    var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'});
        
    map = L.map('map', {
        center: [19.4007336,-99.1236127],
        zoom: 11,
        layers: [osm]
    });
    
    var baseMaps = {
        "OpenStreetMap": osm,
        "OpenStreetMap.HOT": osmHOT
    };
    
    var linea1 = L.layerGroup().addTo(map)
    var linea2 = L.layerGroup().addTo(map)
    var linea3 = L.layerGroup().addTo(map)
    var linea4 = L.layerGroup().addTo(map)
    var linea5 = L.layerGroup().addTo(map)
    var linea6 = L.layerGroup().addTo(map)
    var linea7 = L.layerGroup().addTo(map)
    var linea8 = L.layerGroup().addTo(map)
    var linea9 = L.layerGroup().addTo(map)
    var linea12 = L.layerGroup().addTo(map)
    var lineaA = L.layerGroup().addTo(map)
    var lineaB = L.layerGroup().addTo(map)

    
    estaciones.forEach(element => {
        if (element.linea=='01') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('01')},{draggable: true}).bindPopup(descripcion)
                linea1.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('01')},{draggable: true}).bindPopup(descripcion)
                linea1.addLayer(marker)
            }
        }else if (element.linea=='02') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('02')},{draggable: true}).bindPopup(descripcion)
                linea2.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('02')},{draggable: true}).bindPopup(descripcion)
                linea2.addLayer(marker)
            }
        }else if (element.linea=='03') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('03')},{draggable: true}).bindPopup(descripcion)
                linea3.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('03')},{draggable: true}).bindPopup(descripcion)
                linea3.addLayer(marker)
            }
        }else if (element.linea=='04') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('04')},{draggable: true}).bindPopup(descripcion)
                linea4.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('04')},{draggable: true}).bindPopup(descripcion)
                linea4.addLayer(marker)
            }
        }else if (element.linea=='05') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('05')},{draggable: true}).bindPopup(descripcion)
                linea5.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('05')},{draggable: true}).bindPopup(descripcion)
                linea5.addLayer(marker)
            }
        }else if (element.linea=='06') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('06')},{draggable: true}).bindPopup(descripcion)
                linea6.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('06')},{draggable: true}).bindPopup(descripcion)
                linea6.addLayer(marker)
            }
        }else if (element.linea=='07') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('07')},{draggable: true}).bindPopup(descripcion)
                linea7.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('07')},{draggable: true}).bindPopup(descripcion)
                linea7.addLayer(marker)
            }
        }else if (element.linea=='08') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('08')},{draggable: true}).bindPopup(descripcion)
                linea8.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('08')},{draggable: true}).bindPopup(descripcion)
                linea8.addLayer(marker)
            }
        }else if (element.linea=='09') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('09')},{draggable: true}).bindPopup(descripcion)
                linea9.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('09')},{draggable: true}).bindPopup(descripcion)
                linea9.addLayer(marker)
            }
        }else if (element.linea=='12') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('12')},{draggable: true}).bindPopup(descripcion)
                linea12.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('12')},{draggable: true}).bindPopup(descripcion)
                linea12.addLayer(marker)
            }
        }else if (element.linea=='LA') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('LA')},{draggable: true}).bindPopup(descripcion)
                lineaA.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('LA')},{draggable: true}).bindPopup(descripcion)
                lineaA.addLayer(marker)
            }
        }else if (element.linea=='LB') {
            let descripcion = creaDescripcion(element.estacion,element.id_estacion)
            let total = obtieneTotal(element.id_estacion)
            if(total){
                marker = L.marker([element.longitud,element.latitud],{icon:iconsB.get('LB')},{draggable: true}).bindPopup(descripcion)
                lineaB.addLayer(marker)
            }else{
                marker = L.marker([element.longitud,element.latitud],{icon:icons.get('LB')},{draggable: true}).bindPopup(descripcion)
                lineaB.addLayer(marker)
            }
        }
        
    })

    var overlayMaps = {
        "Línea 1": linea1,
        "Línea 2": linea2,
        "Línea 3": linea3,
        "Línea 4": linea4,
        "Línea 5": linea5,
        "Línea 6": linea6,
        "Línea 7": linea7,
        "Línea 8": linea8,
        "Línea 9": linea9,
        "Línea 12": linea12,
        "Línea A": lineaA,
        "Línea B": lineaB,

    };
    
    var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map)
    
    var baseMaps = {
        "OpenStreetMap": osm,
        "<span style='color: red'>OpenStreetMap.HOT</span>": osmHOT
    };
    var openTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: 'Map data: © OpenStreetMap contributors, SRTM | Map style: © OpenTopoMap (CC-BY-SA)'
    });
    
    layerControl.addBaseLayer(openTopoMap, "OpenTopoMap");

    var layerObjetos = L.layerGroup()
    var layerAnimales = L.layerGroup()
    var layerAccidentados = L.layerGroup()
    var layerArrollados = L.layerGroup()
    var layerIncidentes = L.layerGroup()
    var layerPersonas = L.layerGroup()
    var layerPuertas = L.layerGroup()
    var layerCables = L.layerGroup()

    estaciones.forEach(element => {
        if(cuentasObjetos[element.id_estacion]>0){
            descripcion = creaDescripcionEventos('Objetos', element.estacion,element.id_estacion)
            marker = L.marker([element.longitud,element.latitud],{icon:iconObjetos},{draggable: true}).bindPopup(descripcion)
            layerObjetos.addLayer(marker)
        } if(cuentasAnimales[element.id_estacion]>0){
            descripcion = creaDescripcionEventos('Animales', element.estacion,element.id_estacion)
            marker = L.marker([element.longitud,element.latitud],{icon:iconAnimales},{draggable: true}).bindPopup(descripcion)
            layerAnimales.addLayer(marker)
        } if(cuentasAccidentados[element.id_estacion]>0){
            descripcion = creaDescripcionEventos('Accidentados', element.estacion,element.id_estacion)
            marker = L.marker([element.longitud,element.latitud],{icon:iconAccidentes},{draggable: true}).bindPopup(descripcion)
            layerAccidentados.addLayer(marker)
        } if(cuentasPersonas[element.id_estacion]>0){
            descripcion = creaDescripcionEventos('Personas', element.estacion,element.id_estacion)
            marker = L.marker([element.longitud,element.latitud],{icon:iconPersonas},{draggable: true}).bindPopup(descripcion)
            layerPersonas.addLayer(marker)
        } if(cuentasIncidentes[element.id_estacion]>0){
            descripcion = creaDescripcionEventos('Incidentes Relevantes', element.estacion,element.id_estacion)
            marker = L.marker([element.longitud,element.latitud],{icon:iconIncidentes},{draggable: true}).bindPopup(descripcion)
            layerIncidentes.addLayer(marker)
        } if(cuentasPuertas[element.id_estacion]>0){
            descripcion = creaDescripcionEventos('Cierre de Puertas', element.estacion,element.id_estacion)
            marker = L.marker([element.longitud,element.latitud],{icon:iconPuertas},{draggable: true}).bindPopup(descripcion)
            layerPuertas.addLayer(marker)
        } if(cuentasCables[element.id_estacion]>0){
            descripcion = creaDescripcionEventos('Cables Robados', element.estacion,element.id_estacion)
            marker = L.marker([element.longitud,element.latitud],{icon:iconCables},{draggable: true}).bindPopup(descripcion)
            layerCables.addLayer(marker)
        } if(cuentasArrollados[element.id_estacion]>0){
            descripcion = creaDescripcionEventos('Arrollados', element.estacion,element.id_estacion)
            marker = L.marker([element.longitud,element.latitud],{icon:iconAccidentes},{draggable: true}).bindPopup(descripcion)
            layerArrollados.addLayer(marker)
        }
        
    })
    
    layerControl.addOverlay(layerObjetos, "Objetos");
    layerControl.addOverlay(layerAnimales, "Animales");
    layerControl.addOverlay(layerArrollados, "Arrollados");
    layerControl.addOverlay(layerAccidentados, "Accidentados");
    layerControl.addOverlay(layerIncidentes, "Incidentes");
    layerControl.addOverlay(layerPersonas, "Personas");
    layerControl.addOverlay(layerPuertas, "Puertas");
    layerControl.addOverlay(layerCables, "Cables");
    
}

function creaDescripcion(Pnombre,Pestacion){
    let descripcion = '<b>'+Pnombre+'</b><br>'
    descripcion+= 'Objetos en vías: '        +cuentasObjetos[Pestacion]     +'<br>'
    descripcion+= 'Animales en vías: '       +cuentasAnimales[Pestacion]    +'<br>'
    descripcion+= 'Arrollados en vías: '   +cuentasArrollados[Pestacion]+'<br>'
    descripcion+= 'Accidentados en vías: '   +cuentasAccidentados[Pestacion]+'<br>'
    descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[Pestacion]    +'<br>'
    descripcion+= 'Incidentes Relevantes: '  +cuentasIncidentes[Pestacion]  +'<br>'
    descripcion+= 'Cierre de Puertas: '      +cuentasPuertas[Pestacion]     +'<br>'
    descripcion+= 'Cables Robados: '      +cuentasCables[Pestacion]     +'<br>'
    return descripcion
}

function obtieneTotal(Pestacion){
    if(cuentasObjetos[Pestacion]>=5){
        return true
    }else if(cuentasAnimales[Pestacion]>=5){
        return true
    }else if(cuentasAccidentados[Pestacion]>=5){
        return true
    }else if(cuentasArrollados[Pestacion]>=5){
        return true
    }else if(cuentasPersonas[Pestacion]>=5){
        return true
    }else if(cuentasIncidentes[Pestacion]>=5){
        return true
    }else if(cuentasPuertas[Pestacion]>=5){
        return true
    }else if(cuentasCables[Pestacion]>=5){
        return true
    }else{
        return false
    }
}

function creaDescripcionEventos(Pevento,Pnombre,Pestacion){
    let descripcion = '<b>'+Pnombre+'</b><br>'
    /* if (Pevento != 'Incidentes Relevantes' || Pevento != 'Cierre de puertas') {
        descripcion+= Pevento+ ' en vías: '        +cuentasObjetos[Pestacion]     +'<br>'
    }else{
        descripcion+= Pevento+': '+cuentasObjetos[Pestacion]     +'<br>'
    } */
    if(Pevento == 'Objetos'){
        descripcion+= Pevento+ ' en vías: '        +cuentasObjetos[Pestacion]     +'<br>'
    }else if(Pevento == 'Animales'){
        descripcion+= Pevento+ ' en vías: '        +cuentasAnimales[Pestacion]     +'<br>'
    }else if(Pevento == 'Accidentados'){
        descripcion+= Pevento+ ' en vías: '        +cuentasAccidentados[Pestacion]     +'<br>'
    }else if(Pevento == 'Incidentes Relevantes'){
        descripcion+= Pevento+ ' : '        +cuentasIncidentes[Pestacion]     +'<br>'
    }else if(Pevento == 'Personas'){
        descripcion+= Pevento+ ' Ajenas en vías: '        +cuentasPersonas[Pestacion]     +'<br>'
    }else if(Pevento == 'Cierre de Puertas'){
        descripcion+= Pevento+ ' : '        +cuentasPuertas[Pestacion]     +'<br>'
    }else if(Pevento == 'Cables Robados'){
        descripcion+= Pevento+ ' : '        +cuentasCables[Pestacion]     +'<br>'
    }else if(Pevento == 'Arrollados'){
        descripcion+= Pevento+ ' : '        +cuentasArrollados[Pestacion]     +'<br>'
    }
    
    return descripcion
}