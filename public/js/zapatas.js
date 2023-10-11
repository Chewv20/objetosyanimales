const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

$(document).ready(function(){
    


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
    Pdescripcion = document.getElementById('descripcion').value
    Phumo = document.getElementById('humo').value

    fetch('/zapatas/getReporte/',{
        method : 'POST',
        body: JSON.stringify({
            fecha :  Pfecha,     
            linea :  Plinea,
            hora : Phora,
            descripcion : Pdescripcion,
            humo : Phumo,  
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
                text: 'ID: '+data[0].id}
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
    Pdescripcion = document.getElementById('descripcion').value
    Phumo = document.getElementById('humo').value
    Pusuario = document.getElementById('usuario').value

    
    fetch('/zapatas/',{
        method : 'POST',
        body: JSON.stringify({
            fecha :  Pfecha,     
            linea :  Plinea,
            hora : Phora,
            descripcion : Pdescripcion,
            humo : Phumo,
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
    document.getElementById('descripcion').value = ''
    document.getElementById('humo').value = ""

    actualizarTabla()
}

function generaTabla(){
    new DataTable(zapatas, {
        responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
        },
        ajax : {
            method : "POST",
            url : "/zapatas/get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        columns: [
            { data: 'fecha' },
            { data: 'hora' },
            { data: 'linea' },
            { data: 'descripcion' },
            { data: 'humo' },
            {
                "data": null,
                "bSortable": false,
                "mRender": function(data, type, value) {
                    return '<a href="/zapatas/'+value["id"]+'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a> <a href="/zapatas/delete/'+value["id"]+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>'
                    
                }
            },
        ],
        processing: true,
        serverSide: true    
    });

}

function actualizarTabla(){
    $('#zapatas').DataTable().ajax.reload();
}