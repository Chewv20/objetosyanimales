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
                timer: 500
            })
        }
    })

    table = $('#objetosVia').DataTable({
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
        order: [[1, 'asc']],
        "aLengthMenu": [[10,25,50, -1], [ 10, 25, 50, 'Todos']],
        columns: [
            { data: 'linea', 'width': '5%' },
            { data: 'fecha', 'width': '7%' },
            { data: 'estacion', 'width': '15%' },
            { data: 'retardo', 'width': '8%' },
            { data: 'corte_corriente', 'width': '20%' },
            { data: 'tipo_objeto', 'width': '20%' },
            {
                "data": null,
                "bSortable": false,
                'width': '20%',
                "mRender": function(data, type, value) {
                    return '<a href="/objeto/'+value["id"]+'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a> <a href="/objeto/delete/'+value["id"]+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>'
                    
                }
            },
        ],
        processing: true,
        serverSide: true,
        dom: 'Brtilp',
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
                "targets": [0,1,2,3,4,5,6], 
                "className": "text-center",
           },
        ]
    })

    $("#lineaFiltro").keyup(function(){
        table.column($(this).data('index')).search(this.value).draw()
    })

    $("#estacionFiltro").keyup(function(){
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
            document.getElementById('estacionFiltro').value = ''
            generaTablaF(fecha1,fecha2)
        }
    })

    document.getElementById('borrarFecha').addEventListener('click',(e)=>{
        generaTabla()
        document.getElementById('fechaDesde').value = ''
        document.getElementById('fechaHasta').value = ''
        document.getElementById('lineaFiltro').value = ''
        document.getElementById('estacionFiltro').value = ''
    })

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
                timer : 500,
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
    Pusuario = document.getElementById('usuario').value

    
    fetch('/objeto/',{
        method : 'POST',
        body: JSON.stringify({
            linea :  Plinea,
            fecha :  Pfecha,     
            estacion :  Pestacion,     
            retardo :  Pretardo,     
            corte_corriente :  Pcorte_corriente,     
            tipo_objeto :  Ptipo_objeto,
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
                timer: 500
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
    $('#objetosVia').DataTable().destroy();

    table = $('#objetosVia').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
        },
        ajax : {
            method : "POST",
            url : "/objeto/get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        order: [[1, 'asc']],
        },
        order: [[1, 'asc']],
        "aLengthMenu": [[10,25,50, -1], [ 10, 25, 50, 'Todos']],
        columns: [
            { data: 'linea', 'width': '5%' },
            { data: 'fecha', 'width': '7%' },
            { data: 'estacion', 'width': '15%' },
            { data: 'retardo', 'width': '8%' },
            { data: 'corte_corriente', 'width': '20%' },
            { data: 'tipo_objeto', 'width': '20%' },
            {
                "data": null,
                "bSortable": false,
                'width': '20%',
                "mRender": function(data, type, value) {
                    return '<a href="/objeto/'+value["id"]+'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a> <a href="/objeto/delete/'+value["id"]+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>'
                    
                }
            },
        ],
        processing: true,
        serverSide: true,
        dom: 'Brtilp',
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
                "targets": [0,1,2,3,4,5,6], 
                "className": "text-center",
           },
        ],

    });
    
}

function generaTablaF(Pfecha1, Pfecha2){
    $('#objetosVia').DataTable().destroy();

    table = $('#objetosVia').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json',
        },
        ajax : {
            method : "POST",
            url : "/objeto/getfiltro",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                fecha1 : Pfecha1,
                fecha2 : Pfecha2,
            },
        },
        order: [[1, 'asc']],
        "aLengthMenu": [[10,25,50, -1], [ 10, 25, 50, 'Todos']],
        columns: [
            { data: 'linea', 'width': '5%' },
            { data: 'fecha', 'width': '7%' },
            { data: 'estacion', 'width': '15%' },
            { data: 'retardo', 'width': '8%' },
            { data: 'corte_corriente', 'width': '20%' },
            { data: 'tipo_objeto', 'width': '20%' },
            {
                "data": null,
                "bSortable": false,
                'width': '20%',
                "mRender": function(data, type, value) {
                    return '<a href="/objeto/'+value["id"]+'" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>Editar</a> <a href="/objeto/delete/'+value["id"]+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>'
                    
                }
            },
        ],
        processing: true,
        serverSide: true,
        dom: 'Brtilp',
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
                "targets": [0,1,2,3,4,5,6], 
                "className": "text-center",
                
           },
        ]

    });
    
}

function actualizarTabla(){
    $('#objetosVia').DataTable().ajax.reload();
}