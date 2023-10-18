const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    $(document).ready(function(){
        iniciaEstadisticas()
        document.getElementById('filtro').addEventListener('click',(e)=>{
            actualizaEstadisticas()
        })
        var map = L.map('map').setView([19.3907336,-99.1436127],11);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
        maxZoom: 18
        }).addTo(map);
        L.control.scale().addTo(map);
        var LeafIcon = L.Icon.extend({
            options: {
                iconSize:     [15, 15],
                iconAnchor:   [0, 0],
                popupAnchor:  [-3, -76]
            }
        })
        var pinkIcon = new LeafIcon({iconUrl: '../img/pink_circle.png'})
        L.marker([19.398188, -99.2010858],{icon:pinkIcon},{draggable: true}).addTo(map);
        L.marker([19.4021400, -99.1875167],{icon:pinkIcon},{draggable: true}).addTo(map);
        L.marker([19.4132005,-99.1824341],{icon:pinkIcon},{draggable: true}).addTo(map);
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
        document.getElementById('numObjetos').innerHTML= data[0]
        document.getElementById('numAnimales').innerHTML= data[1]
        document.getElementById('numAccidentados').innerHTML= data[2]
        document.getElementById('numPersonasAjenas').innerHTML= data[3]
        document.getElementById('numIncidentes').innerHTML= data[4]
        document.getElementById('numPuertas').innerHTML= data[5]
        document.getElementById('numZapatas').innerHTML= data[6]
        document.getElementById('total').innerHTML= data[7]
        

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