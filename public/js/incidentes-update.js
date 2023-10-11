const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

$(document).ready(function(){
    document.getElementById('selLinea').addEventListener('change',(e)=>{
        
        fetch('/estaciones2/get/',{
            method : 'POST',
            body: JSON.stringify({
                linea :  e.target.value,     
            }),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response=>{
            return response.json()
        }).then( data=>{      
            var opciones="<option value='' selected>-- Seleccione una estación --</option>"
            for(let i in data){
                opciones+= '<option value="'+data[i].id_estacion+'">'+data[i].estacion+'</option>';
            }

            document.getElementById("selEstacion").innerHTML=opciones;
        }).catch(error => console.error(error));
    })
    
    let linea = document.getElementById('selLinea').value
    let estacion = document.getElementById('estacion').value
    obtieneEstaciones(linea,estacion)
})

function obtieneEstaciones(Plinea,Pestacion){
    fetch('/estaciones2/get/',{
        method : 'POST',
        body: JSON.stringify({
            linea :  Plinea,     
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{      
        var opciones="<option value='' >-- Seleccione una estación --</option>"
        for(let i in data){
            if (data[i].id_estacion==Pestacion) {
                opciones+= '<option value="'+data[i].id_estacion+'" selected >'+data[i].estacion+'</option>'
            }else{
                opciones+= '<option value="'+data[i].id_estacion+'">'+data[i].estacion+'</option>'
            }
        }
        document.getElementById("selEstacion").innerHTML=opciones;
    }).catch(error => console.error(error));
}



