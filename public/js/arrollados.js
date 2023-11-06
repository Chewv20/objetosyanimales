const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
var table
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
                text: 'Revisa que todos los campos sean correctos',
                timer : 500,
            })
        }
    })

    table = $('#arrolladosVias').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
        },
        ajax : {
            method : "POST",
            url : "/arrollados/get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        "aLengthMenu": [[10,25,50, -1], [ 10, 25, 50, 'Todos']],
        columns: [
            { data: 'fecha','width': '7%' },
            { data: 'linea','width': '4%' },
            { data: 'hora','width': '4%' },
            { data: 'estacion','width': '10%' },
            { data: 'descripcion' },
            { data: 'status' },
            { data: 'genero' },
            { data: 'edad','width': '1%' },
            { data: 'retardo','width': '1%' },
            {
                "data": null,
                'width': '8%',
                "bSortable": false,
                "mRender": function(data, type, value) {
                    return '<a href="/arrollados/'+value["id"]+'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a> <a href="/arrollados/delete/'+value["id"]+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>'
                    
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
            
        ],
        keys : true,
        'columnDefs': [
            {
                "targets": [0,1,2,3,5,6,7,8,9], 
                "className": "text-center",
            },
            {
                "targets": [4], 
                "className": "text-justify",
            },
        ]
    })

    $("#lineaFiltro").keyup(function(){
        table.column($(this).data('index')).search(this.value).draw()
    })

    $("#descripcionFiltro").keyup(function(){
        table.column($(this).data('index')).search(this.value).draw()
    })

    document.getElementById('filtroFecha').addEventListener('click',(e)=>{
        fecha1 = document.getElementById('fechaDesde').value
        fecha2 = document.getElementById('fechaHasta').value
        if(fecha1=='' || fecha2==''){
            Swal.fire({
                icon: 'error',
                title: 'Fecha no válida',
                text: 'Revisa que las dos fechas sean correctas',
                timer : 500,
            })
        }else{
            document.getElementById('lineaFiltro').value = ''
            document.getElementById('descripcionFiltro').value = ''
            generaTablaF(fecha1,fecha2)
        }
    })

    document.getElementById('borrarFecha').addEventListener('click',(e)=>{
        generaTabla()
        document.getElementById('fechaDesde').value = ''
        document.getElementById('fechaHasta').value = ''
        document.getElementById('lineaFiltro').value = ''
        document.getElementById('descripcionFiltro').value = ''
    })
    
})

function validar(){
    let error = false;

        let inputsrequeridos = document.querySelectorAll('#form-arrollados [required]')  
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
    Pstatus = document.getElementById('status').value
    Pgenero = document.getElementById('genero').value
    Pedad = document.getElementById('edad').value
    Pretardo = document.getElementById('retardo').value


    fetch('/arrollados/getReporte/',{
        method : 'POST',
        body: JSON.stringify({
            fecha :  Pfecha,     
            linea :  Plinea,
            hora : Phora,
            estacion :  Pestacion,     
            descripcion : Pdescripcion,
            status : Pstatus,
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
                timer : 500,
                text: 'Id reporte: '+data[0].id}
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
    Pstatus = document.getElementById('status').value
    Pgenero = document.getElementById('genero').value
    Pedad = document.getElementById('edad').value
    Pretardo = document.getElementById('retardo').value
    Pusuario = document.getElementById('usuario').value

    
    fetch('/arrollados/',{
        method : 'POST',
        body: JSON.stringify({
            fecha :  Pfecha,     
            linea :  Plinea,
            hora : Phora,
            estacion :  Pestacion,     
            descripcion : Pdescripcion,
            status : Pstatus,
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
                timer : 500,
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
    document.getElementById('status').value = ""
    document.getElementById('retardo').value = ""
    document.getElementById('genero').value = ''
    document.getElementById('edad').value = ''


    actualizarTabla()
}

function generaTablaF(Pfecha1,Pfecha2){
    $('#arrolladosVias').DataTable().destroy();

    table = $('#arrolladosVias').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
        },
        ajax : {
            method : "POST",
            url : "/arrollados/getfiltro",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                fecha1 : Pfecha1,
                fecha2 : Pfecha2,
            }
        },
        "aLengthMenu": [[10,25,50, -1], [ 10, 25, 50, 'Todos']],
        columns: [
            { data: 'fecha','width': '7%' },
            { data: 'linea','width': '4%' },
            { data: 'hora','width': '4%' },
            { data: 'estacion','width': '10%' },
            { data: 'descripcion' },
            { data: 'status' },
            { data: 'genero' },
            { data: 'edad','width': '1%' },
            { data: 'retardo','width': '1%' },
            {
                "data": null,
                'width': '8%',
                "bSortable": false,
                "mRender": function(data, type, value) {
                    return '<a href="/arrollados/'+value["id"]+'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a> <a href="/arrollados/delete/'+value["id"]+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>'
                    
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
            
        ],
        keys : true,
        'columnDefs': [
            {
                "targets": [0,1,2,3,5,6,7,8,9], 
                "className": "text-center",
            },
            {
                "targets": [4], 
                "className": "text-justify",
            },
        ]  
    });

}

function generaTabla(){
    $('#arrolladosVias').DataTable().destroy();

    table = $('#arrolladosVias').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
        },
        ajax : {
            method : "POST",
            url : "/arrollados/get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        },
        "aLengthMenu": [[10,25,50, -1], [ 10, 25, 50, 'Todos']],
        columns: [
            { data: 'fecha','width': '7%' },
            { data: 'linea','width': '4%' },
            { data: 'hora','width': '4%' },
            { data: 'estacion','width': '10%' },
            { data: 'descripcion' },
            { data: 'status' },
            { data: 'genero' },
            { data: 'edad','width': '1%' },
            { data: 'retardo','width': '1%' },
            {
                "data": null,
                'width': '8%',
                "bSortable": false,
                "mRender": function(data, type, value) {
                    return '<a href="/arrollados/'+value["id"]+'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a> <a href="/arrollados/delete/'+value["id"]+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>'
                    
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
            
        ],
        keys : true,
        'columnDefs': [
            {
                "targets": [0,1,2,3,5,6,7,8,9], 
                "className": "text-center",
            },
            {
                "targets": [4], 
                "className": "text-justify",
            },
        ]  
    });

}

function actualizarTabla(){
    $('#arrolladosVias').DataTable().ajax.reload();
}