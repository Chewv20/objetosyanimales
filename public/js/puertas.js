const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

$(document).ready(function(){
    document.getElementById('selLinea').addEventListener('change',(e)=>{
        console.log(e.target.value);
        fetch('/estacionesvias/get/',{
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


    document.getElementById('submit').addEventListener('click',(e)=>{
        e.preventDefault()
        let resultado = validar();
            
        if(!resultado){                
            compruebaRep()
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Revisa los campos',
                text: 'Revisa que todos los campos sean correctos'
            })
        }
    })

    generaTabla()
})

function validar(){
    let error = false;

        let inputsrequeridos = document.querySelectorAll('#form-puertas [required]')  
        for(let i=0;i<inputsrequeridos.length;i++){
            if(inputsrequeridos[i].value =='' ){
                inputsrequeridos[i].style.borderColor = '#FF0400'
                error = true
            }else{
                inputsrequeridos[i].style.removeProperty('border');
            }
        }

        return error;

}

function compruebaRep(){
    Pfecha = document.getElementById('fecha').value
    Plinea = document.getElementById('selLinea').value
    Phora = document.getElementById('hora').value
    Pestacion = document.getElementById('selEstacion').value
    Pdescripcion = document.getElementById('descripcion').value
    Ppuerta_opuesta = document.getElementById('puerta_opuesta').value
    Pdesalojo = document.getElementById('desalojo').value
    Pasistencia_policia = document.getElementById('asistencia_policia').value

    fetch('/puertas/getReporte/',{
        method : 'POST',
        body: JSON.stringify({
            fecha :  Pfecha,     
            linea :  Plinea,
            hora : Phora,
            estacion :  Pestacion,     
            descripcion : Pdescripcion,
            puerta_opuesta : Ppuerta_opuesta,
            desalojo : Pdesalojo,
            asistencia_policia : Pasistencia_policia,    
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{      
        if(data[0]){            
            Swal.fire(
                {icon: 'error',
                title: 'Se intenta guardar un reporte existente',
                text: data[0].id}
            )
        
        }else{
            guardar();
        }
    }).catch(error => console.error(error));
}

function guardar(){
    Pfecha = document.getElementById('fecha').value
    Plinea = document.getElementById('selLinea').value
    Phora = document.getElementById('hora').value
    Pestacion = document.getElementById('selEstacion').value
    Pdescripcion = document.getElementById('descripcion').value
    Ppuerta_opuesta = document.getElementById('puerta_opuesta').value
    Pdesalojo = document.getElementById('desalojo').value
    Pasistencia_policia = document.getElementById('asistencia_policia').value
    Pusuario = document.getElementById('usuario').value

    
    fetch('/puertas/',{
        method : 'POST',
        body: JSON.stringify({
            fecha :  Pfecha,     
            linea :  Plinea,
            hora : Phora,
            estacion :  Pestacion,     
            descripcion : Pdescripcion,
            puerta_opuesta : Ppuerta_opuesta,
            desalojo : Pdesalojo,
            asistencia_policia : Pasistencia_policia,
            usuario : Pusuario,
        }),
        headers:{
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    }).then(response=>{
        return response.json()
    }).then( data=>{
        if(data){
            Swal.fire(
                {icon: 'success',
                title: 'Reporte guardado con éxito',
                }
            )
            limpiar() 
        }
        
    }).catch(error => console.error(error));

    return true

}

function limpiar(){
    document.getElementById('fecha').value = ""
    document.getElementById('selLinea').value = '0'
    document.getElementById('hora').value = ""
    document.getElementById('selEstacion').value = '0'
    document.getElementById('descripcion').value = ''
    document.getElementById('puerta_opuesta').value = ""
    document.getElementById('desalojo').value = ""
    document.getElementById('asistencia_policia').value = ''

    actualizarTabla()
}

function generaTabla(){
    new DataTable(puertas, {
        responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
        },
        ajax : {
            method : "POST",
            url : "/puertas/get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        columns: [
            { data: 'fecha' },
            { data: 'linea' },
            { data: 'hora' },
            { data: 'estacion' },
            { data: 'descripcion' },
            { data: 'puerta_opuesta' },
            { data: 'desalojo' },
            { data: 'asistencia_policia' },
            {
                "data": null,
                "bSortable": false,
                "mRender": function(data, type, value) {
                    return '<a href="/puertas/'+value["id"]+'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a> <a href="/puertas/delete/'+value["id"]+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>'
                    
                }
            },
        ],
        processing: true,
        serverSide: true    
    });

}

function actualizarTabla(){
    $('#puertas').DataTable().ajax.reload();
}