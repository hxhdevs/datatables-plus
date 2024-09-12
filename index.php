<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>DataTables</title>
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->       
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">    
      
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Font Awesome usando CDN -->
     <!-- Font Awesome local -->
    <link rel="stylesheet" type="text/css" href="assets/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  </head>
    
  <body> 
    <header>
        <h3 class='text-center'></h3>
    </header>    
    <div class="container caja">
        <div class="row">
            <!-- Colocando botn de agregar a la derecha -->
            <div class="col-lg-12 d-flex justify-content-end">  
                <button id="btnNuevo" type="button" class="btn btn-primary" data-toggle="modal">
                    <i class="fas fa-plus"></i>
                </button>
            </div>    
            <!-- Fin del boton -->
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Usuario</th>                                
                            <th>No. Nomina</th>  
                            <th>Centro de costos</th>
                            <th>Correo</th>
                            <th>estatus</th>
                            <th>Centro de trabajo</th>
                            <th>Rol</th>
                            <th>Fecha alta</th>
                            <th>Fecha baja</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>                           
                    </tbody>        
                </table>               
            </div>
            </div>
        </div>  
    </div>   

<!--Modal para CRUD-->
<div class="modal fade" id="modalUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formUsuarios">    
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">Usuario:</label>
                        <input type="text" class="form-control" id="username">
                    </div> 
                    </div>    
                </div>
                <div class="row"> 
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">No. Nomina</label>
                        <input type="text" class="form-control" id="nonomina">
                    </div>               
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">Centro de costos</label>
                        <input type="text" class="form-control" id="centrocostos">
                    </div>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                        <label for="" class="col-form-label">Correo</label>
                            <input type="text" class="form-control" id="correo">
                        </div>
                    </div>    
                    <div class="col-lg-3">    
                        <div class="form-group">
                        <label for="" class="col-form-label">estatus</label>
                            <input type="number" class="form-control" id="estatus">
                        </div>            
                    </div>    
                </div>                
                <div class="row">
                    <div class="col-lg-9">
                        <div class="form-group">
                        <label for="" class="col-form-label">Centros de trabajo</label>
                            <input type="text" class="form-control" id="centrotrabajo">
                        </div>
                    </div>    
                    <div class="col-lg-3">    
                        <div class="form-group">
                        <label for="" class="col-form-label">Rol</label>
                            <input type="number" class="form-control" id="rol">
                        </div>            
                    </div>    
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>    
    
    
  </body>
</html>
<script>
$(document).ready(function() {
    var fila_id, opcion;
    opcion = 4;

    var tablaUsuarios = $('#tablaUsuarios').DataTable({  
        "ajax": {            
            "url": "bd/Usuarios.php", 
            "method": 'POST',
            "data": {opcion: opcion}, 
            "dataSrc": ""
        },
        "columns": [
            {"data": "pk_id"},
            {"data": "nombre"},
            {"data": "usuario"},
            {"data": "nonomina"},
            {"data": "centro_costo"},
            {"data": "correo"},
            {"data": "estatus"},
            {"data": "fk_centros_trabajo"},
            {"data": "rol"},
            {"data": "fecha_alta"},
            {"data": "fecha_baja"},
            {"data": "opciones"}
        ],
        "scrollY": "400px",  // Altura vertical del scroll
        "scrollX": true,     // Activar el scroll horizontal
        "scrollCollapse": true,  // Permite colapsar el scroll si la tabla es más pequeña
        "paging": true,      // Activa la paginación
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json" // Traducción al español (opcional)
        }
    });

    function marcarCampoInvalido(input) {
        input.addClass('is-invalid'); // Agrega borde rojo
        setTimeout(() => input.removeClass('is-invalid'), 3000); // Remueve la clase después de 3 segundos
    }

    function validarCampos() {
        const campos = ['#nombre', '#username', '#nonomina', '#centrocostos', '#correo', '#estatus', '#centrotrabajo', '#rol'];
        let camposValidos = true;
        campos.forEach(campo => {
            const input = $(campo);
            if ($.trim(input.val()) === '') {
                marcarCampoInvalido(input);
                camposValidos = false; // Algún campo es inválido
            }
        });
        return camposValidos; // Retorna si todos los campos son válidos
    }


    $('#formUsuarios').submit(function(e) {                       
        e.preventDefault();

        // Validar campos
        if (!validarCampos()) {
            return; // No enviar el formulario si algún campo es inválido
        }

        // Obtener valores de los campos
        var nombre = $.trim($('#nombre').val());
        var username = $.trim($('#username').val());
        var nonomina = $.trim($('#nonomina').val());
        var centrocostos = $.trim($('#centrocostos').val());
        var correo = $.trim($('#correo').val());
        var estatus = $.trim($('#estatus').val());
        var centrotrabajo = $.trim($('#centrotrabajo').val());
        var rol = $.trim($('#rol').val());

        // Realizar la petición AJAX
        $.ajax({
            url: "bd/Usuarios.php",
            type: "POST",
            datatype: "json",    
            data: {
                pk_id: fila_id, 
                nombre: nombre, 
                username: username, 
                nonomina: nonomina, 
                centrocostos: centrocostos, 
                correo: correo, 
                estatus: estatus, 
                centrotrabajo: centrotrabajo, 
                rol: rol, 
                opcion: opcion
            },    
            success: function(data) {
                tablaUsuarios.ajax.reload(null, false);
            }
        });			        
        $('#modalUsuarios').modal('hide');											     			
    });

    $("#btnNuevo").click(function(){
        opcion = 1;
        fila_id = null;
        $("#formUsuarios").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Alta de Usuario");
        $('#modalUsuarios').modal('show');	    
    });

    $(document).on("click", ".btnEditar", function(){
        opcion = 2;
        fila = $(this).closest("tr");	        
        fila_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		    
        var nombre = fila.find('td:eq(1)').text();
        var username = fila.find('td:eq(2)').text();
        var nonomina = fila.find('td:eq(3)').text();
        var centrocostos = fila.find('td:eq(4)').text();
        var correo = fila.find('td:eq(5)').text();
        var estatus = fila.find('td:eq(6)').text();
        var centrotrabajo = fila.find('td:eq(7)').text();
        var rol = fila.find('td:eq(8)').text();
        $("#nombre").val(nombre);
        $("#username").val(username);
        $("#nonomina").val(nonomina);
        $("#centrocostos").val(centrocostos);
        $("#correo").val(correo);
        $("#estatus").val(estatus);
        $("#centrotrabajo").val(centrotrabajo);
        $("#rol").val(rol);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Usuario");		
        $('#modalUsuarios').modal('show');		   
    });

    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        fila_id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+fila_id+"?");                
        if (respuesta) {            
            $.ajax({
                url: "bd/Usuarios.php",
                type: "POST",
                datatype:"json",    
                data: {opcion:opcion, pk_id:fila_id},    
                success: function() {
                    tablaUsuarios.row(fila.parents('tr')).remove().draw();                  
                }
            });	
        }
    });
});

</script>