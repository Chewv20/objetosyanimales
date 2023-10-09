const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

$(document).ready(function(){
    document.getElementById('selLinea').addEventListener('change',(e)=>{
        
        fetch('/estaciones/get/',{
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
            var opciones="<option value='0' selected>-- Seleccione una estación --</option>"
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

        let inputsrequeridos = document.querySelectorAll('#form-objeto [required]')  
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
    Plinea = document.getElementById('selLinea').value
    Pestacion = document.getElementById('selEstacion').value
    Pretardo = document.getElementById('retardo').value
    Pfecha = document.getElementById('fecha').value
    Pcorte_corriente = document.getElementById('corte_corriente').value
    Ptipo_objeto = document.getElementById('tipo_objeto').value

    fetch('/objeto/getReporte/',{
        method : 'POST',
        body: JSON.stringify({
            linea :  Plinea,
            estacion :  Pestacion,     
            retardo :  Pretardo,     
            fecha :  Pfecha,     
            corte_corriente :  Pcorte_corriente,     
            tipo_objeto :  Ptipo_objeto,     

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
    Plinea = document.getElementById('selLinea').value
    Pestacion = document.getElementById('selEstacion').value
    Pretardo = document.getElementById('retardo').value
    Pfecha = document.getElementById('fecha').value
    Pcorte_corriente = document.getElementById('corte_corriente').value
    Ptipo_objeto = document.getElementById('tipo_objeto').value

    
    fetch('/objeto/',{
        method : 'POST',
        body: JSON.stringify({
            linea :  Plinea,
            fecha :  Pfecha,     
            estacion :  Pestacion,     
            retardo :  Pretardo,     
            corte_corriente :  Pcorte_corriente,     
            tipo_objeto :  Ptipo_objeto,
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
    document.getElementById('selLinea').value = '0'
    document.getElementById('selEstacion').value = '0'
    document.getElementById('retardo').value = ""
    document.getElementById('fecha').value = ""
    document.getElementById('corte_corriente').value = ''
    document.getElementById('tipo_objeto').value = ""

    actualizarTabla()
}

function generaTabla(){
    new DataTable(objetosVia, {
        responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
        },
        ajax : {
            method : "POST",
            url : "/objeto/get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        columns: [
            { data: 'linea' },
            { data: 'fecha' },
            { data: 'estacion' },
            { data: 'retardo' },
            { data: 'corte_corriente' },
            { data: 'tipo_objeto' },
            {
                "data": null,
                "bSortable": false,
                "mRender": function(data, type, value) {
                    return '<a href="/objeto/'+value["id"]+'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a> <a href="/objeto/delete/'+value["id"]+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>'
                    
                }
            },
        ],
        processing: true,
        serverSide: true    
    });

}

function actualizarTabla(){
    $('#objetosVia').DataTable().ajax.reload();
}