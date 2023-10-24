const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
let cuentasObjetos = []
let cuentasAnimales = []
let cuentasAccidentados = []
let cuentasPersonas = []
let cuentasIncidentes = []
let cuentasPuertas = []
let estaciones = []
let lineas = ['01','02','03','04','05','06','07','08','09','12','LA','LB'];
var map = L.map('map').setView([19.4007336,-99.1236127], 11)

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
        obtieneEstaciones2()
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

function obtieneEstaciones2(){
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
        actualizaMapa()
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
    
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    lineas.forEach(element1 =>{
        estaciones.forEach(element => {
            if (element.linea==element1) {
                let descripcion = creaDescripcion(element.estacion,element.id_estacion)
                let total = obtieneTotal(element.id_estacion)
                if(total>=3){
                    L.marker([element.longitud,element.latitud],{icon:iconsB.get(element1)},{draggable: true}).bindPopup(descripcion).addTo(map)
                }else{
                    L.marker([element.longitud,element.latitud],{icon:icons.get(element1)},{draggable: true}).bindPopup(descripcion).addTo(map)
                }
            }
            
        })
    })
    
}

function actualizaMapa(){
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
    
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    lineas.forEach(element1 =>{
        estaciones.forEach(element => {
            if (element.linea==element1) {
                let descripcion = creaDescripcion(element.estacion,element.id_estacion)
                let total = obtieneTotal(element.id_estacion)
                if(total>=3){
                    L.marker([element.longitud,element.latitud],{icon:iconsB.get(element1)},{draggable: true}).bindPopup(descripcion).addTo(map)
                }else{
                    L.marker([element.longitud,element.latitud],{icon:icons.get(element1)},{draggable: true}).bindPopup(descripcion).addTo(map)
                }
            } 
        })
    })

}

function creaDescripcion(Pnombre,Pestacion){
    let descripcion = '<b>'+Pnombre+'</b><br>'
    descripcion+= 'Objetos en vías: '        +cuentasObjetos[Pestacion]     +'<br>'
    descripcion+= 'Animales en vías: '       +cuentasAnimales[Pestacion]    +'<br>'
    descripcion+= 'Accidentados en vías: '   +cuentasAccidentados[Pestacion]+'<br>'
    descripcion+= 'Personas ajenas en vías: '+cuentasPersonas[Pestacion]    +'<br>'
    descripcion+= 'Incidentes Relevantes: '  +cuentasIncidentes[Pestacion]  +'<br>'
    descripcion+= 'Cierre de Puertas: '      +cuentasPuertas[Pestacion]     +'<br>'
    return descripcion
}

function obtieneTotal(Pestacion){
    let total = cuentasObjetos[Pestacion]+cuentasAnimales[Pestacion]+cuentasAccidentados[Pestacion]+cuentasPersonas[Pestacion]+cuentasIncidentes[Pestacion]+cuentasPuertas[Pestacion]
    return total
}