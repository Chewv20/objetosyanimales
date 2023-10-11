const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    $(document).ready(function(){
        actualizaEstadisticas()
        document.getElementById('filtro').addEventListener('click',(e)=>{
            actualizaEstadisticas()
        })
})

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

        

    }).catch(error => console.error(error));
    
    setTimeout(actualizaEstadisticas,5000)
}