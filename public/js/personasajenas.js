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

        let inputsrequeridos = document.querySelectorAll('#form-personasajenas [required]')  
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
    Pgenero = document.getElementById('genero').value
    Pedad = document.getElementById('edad').value
    Pretardo = document.getElementById('retardo').value


    fetch('/personasajenas/getReporte/',{
        method : 'POST',
        body: JSON.stringify({
            fecha :  Pfecha,     
            linea :  Plinea,
            hora : Phora,
            estacion :  Pestacion,     
            descripcion : Pdescripcion,
            genero : Pgenero,
            edad : Pedad,
            retardo :  Pretardo,     
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
    Pgenero = document.getElementById('genero').value
    Pedad = document.getElementById('edad').value
    Pretardo = document.getElementById('retardo').value
    Pusuario = document.getElementById('usuario').value

    
    fetch('/personasajenas/',{
        method : 'POST',
        body: JSON.stringify({
            fecha :  Pfecha,     
            linea :  Plinea,
            hora : Phora,
            estacion :  Pestacion,     
            descripcion : Pdescripcion,
            genero : Pgenero,
            edad : Pedad,
            retardo :  Pretardo,
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
    document.getElementById('retardo').value = ""
    document.getElementById('genero').value = ''
    document.getElementById('edad').value = ''


    actualizarTabla()
}

function generaTabla(){
    new DataTable(personasAjenasVias, {
        responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
        },
        ajax : {
            method : "POST",
            url : "/personasajenas/get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, 'Todos']],
        columns: [
            { data: 'fecha' },
            { data: 'linea' },
            { data: 'hora' },
            { data: 'estacion' },
            { data: 'descripcion' },
            { data: 'genero' },
            { data: 'edad' },
            { data: 'retardo' },
            {
                "data": null,
                "bSortable": false,
                "mRender": function(data, type, value) {
                    return '<a href="/personasajenas/'+value["id"]+'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a> <a href="/personasajenas/delete/'+value["id"]+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>'
                    
                }
            },
        ],
        processing: true,
        serverSide: true,
        dom: 'Bfrtilp',
        buttons: [
            [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-copy"></i>',
                    tittleAttr: 'Copiar al portapapeles',
                    className: 'btn btn-secondary',
                    exportOptions: {
                        columns: [':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i>',
                    tittleAttr: 'Exportar a excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-code"></i>',
                    tittleAttr: 'Exportar a excel',
                    className: 'btn btn-dark',
                    exportOptions: {
                        columns: [ ':visible' ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i>',
                    tittleAttr: 'Exportar a excel',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: [ ':visible' ]
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                    tittleAttr: 'Exportar a excel',
                    className: 'btn btn-info',
                    exportOptions: {
                        columns: [ ':visible' ]
                    }
                },
                'colvis',
            ] 
            
        ]  
    });

}

function actualizarTabla(){
    $('#personasAjenasVias').DataTable().ajax.reload();
}