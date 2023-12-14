 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Proveedores</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Proveedores</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <!-- Main content -->
 <div class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg-12">
                 <table id=tbl_proveedores class="table table-striped w-100 shadow ">
                     <thead class="bg-info">
                         <tr>
                             <th>Id</th>
                             <th>Proveedor</th>
                             <th>N° Productos</th>
                             <th>Propietario</th>
                             <th>Telefono</th>

                         </tr>
                     </thead>
                     <tbody>
                     </tbody>
                 </table>
             </div>
         </div>

         <div class="modal fade" id="mdlGestionarProveedor" role="dialog">
             <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                     <div class="modal-header bg-gradient-gray py-1 align-items-center">
                         <h5 class="modal-title">
                             Agregar Proveedor
                         </h5>
                         <button type="button" class="btn btn-outline-primary text-white border-0 fs-5"
                             id="btnCerrarModal" data-bs-dismiss="modal">
                             <i class="far fa-times-circle"> </i>
                         </button>
                     </div>
                     <div class="modal-body ">
                         <div class="row ">
                             <!-- Descripcion -->
                             <div class="col-lg-12">
                                 <div class="form-group mb-2">
                                     <label class="" for="iptProveedorReg"> <i class="fa-solid fa-user-tie"></i>
                                         <span class="small">Nombre</span><span class="text-danger">*</span>
                                     </label>
                                     <input type="text" class="form-control form-control-sm" id="iptProveedorReg"
                                         name="iptProveedorReg" placeholder="Descripcion" required>
                                     <span id="validate_proveedor" class="text-danger small fst-italic"
                                         style="display:none">Debe
                                         de Ingresar el nombre del proveedor</span>
                                 </div>
                             </div>
                             <div class="col-lg-6">

                                 <div class="form-group mb-2">
                                     <label class="" for="iptPropietarioReg"> <i class="fa-solid fa-user-tie"></i>
                                         <span class="small">Propietario</span><span class="text-danger">*</span>
                                     </label>
                                     <input type="text" class="form-control form-control-sm" id="iptPropietarioReg"
                                         name="iptPropietarioReg" placeholder="Propietario" required>
                                     <span id="validate_propietario" class="text-danger small fst-italic"
                                         style="display:none">Debe
                                         de Ingresar el nombre del propietario</span>
                                 </div>
                             </div>
                             <div class="col-lg-6">
                                 <div class="form-group mb-2">
                                     <label class="" for="iptTelefonoReg"> <i class="fa-solid fa-phone"></i>
                                         <span class="small">Telefono</span><span class="text-danger">*</span>
                                     </label>
                                     <input type="text" class="form-control form-control-sm" id="iptTelefonoReg"
                                         name="iptTelefonoReg" placeholder="Telefono" required>
                                     <span id="validate_telefono" class="text-danger small fst-italic"
                                         style="display:none">Debe
                                         de Ingresar el telefono</span>
                                 </div>

                             </div>

                             <div class="d-flex">
                                 <button type="button" class="btn btn-danger mt-3 mx-2" style="width: 170px"
                                     data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                                 <button type="button" class="btn btn-primary mt-3 mx-2" style="width: 170px"
                                     id="btnGuardarProveedor" onclick="formSubmitClick()">Guardar Proveedor</button>
                             </div>



                         </div>
                     </div>
                 </div>
             </div>
         </div><!-- /.container-fluid -->
     </div>
     <!-- /.content -->
     <script>
     $(document).ready(function() {

         var table;

         $.ajax({

             url: "ajax/proveedores.ajax.php", //cambiar a categorias
             type: "POST",
             data: {
                 'accion': 1
             }, //listar categorias
             dataType: 'json',
             success: function(respuesta) {
                 console.log("respuesta", respuesta);
             }


         });

         table = $("#tbl_proveedores").DataTable({
             dom: "Bfrtip",
             buttons: [{
                     text: '<i class="fa-regular fa-square-plus fa-xl"></i> Agregar Proveedor',
                     className: 'addNewRecord',
                     action: function(e, dt, node, config) {
                         $("#mdlGestionarProveedor").modal('show');

                     }
                 },
                 {
                     extend: 'excel',
                     text: '<i class="fa fa-file-excel"></i> Exportar Excel'
                 },
                 {
                     extend: 'print',
                     text: '<i class="fa fa-print"></i> Imprimir',
                     customize: function(win) {


                         // Obtener la fecha de generación
                         var currentDate = new Date();
                         var formattedDate = currentDate.toLocaleDateString();

                         // Crear un contenedor para el encabezado
                         var header = win.document.createElement('div');
                         header.style.textAlign = 'center';

                         // Agregar la imagen al encabezado (alineada a la izquierda)
                         var img = win.document.createElement('img');
                         img.src =
                             'https://static.wixstatic.com/media/0c0d0c_ff63f0d708c243b3b9d5c7b4e2d2f6de~mv2.png';
                         img.style.width = '250px';
                         img.style.height = 'auto';
                         img.style.float = 'left'; // Mover la imagen a la izquierda
                         header.appendChild(img);

                         // Agregar la información de la tienda al encabezado (Times New Roman, tamaño 18)
                         var info = win.document.createElement('div');
                         info.style.textAlign = 'left';
                         info.style.fontFamily = 'Times New Roman, Times, serif';
                         info.style.fontSize = '18px';
                         info.innerHTML =
                             '<strong>Il Padrino Concept Store Granada</strong><br>' +
                             'Convento San Francisco, 1 y media cuadra al Norte, Granada, Nicaragua<br>' +
                             'Teléfono: 88468274';
                         header.appendChild(info);

                         // Agregar la fecha de generación al lado derecho del encabezado
                         var date = win.document.createElement('div');
                         date.style.textAlign = 'right'; // Alinear a la derecha
                         date.innerHTML = 'Fecha de Generación: ' + formattedDate;
                         header.appendChild(date);

                         // Agregar el encabezado al documento
                         win.document.body.insertBefore(header, win.document.body.firstChild);
                     },
                     /* exportOptions: {
                          columns: ':visible' // Imprimir solo las columnas visibles
                      }*/
                 },
                 {
                     text: '<i class="fa fa-sync"></i> Recargar',
                     className: 'reloadButton', // Agrega una clase al botón
                     action: function(e, dt, node, config) {
                        $('#tbl_proveedores').DataTable().ajax.reload();
                     }
                 },
                 'pageLength'
             ],
             pageLength: [1, 5, 10, 15, 30, 50, 100],
             pageLength: 10,
             ajax: {
                 url: "ajax/proveedores.ajax.php",
                 dataSrc: '',
                 type: "POST",
                 data: {
                     'accion': 1
                 }, //listar productos



             },
             responsive: {
                 details: {
                     type: "column"
                 }

             },
             language: {
                 url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
             }
         });
         
         $("#btnCerrarModal,#btnCancelarRegistro").on("click", function() {

             $("#iptProveedorReg").val('');
             $("#iptPropietarioReg").val('');
             $("#iptTelefonoReg").val('');



             $("#validate_proveedor").css("display", "none");
             $("#validate_propietario").css("display", "none");
             $("#validate_telefono").css("display", "none");

         })

         $("#btnGuardarProveedor").on("click", function() {
             // Obtener los valores de los campos

             var contenidoProveedor = $("#iptProveedorReg").val();
             var contenidoPropietario = $("#iptPropietarioReg").val();
             var contenidoTelefono = $("#iptTelefonoReg").val();




             // Validar que todos los campos estén llenos
             if (contenidoProveedor === '' || contenidoPropietario === '' || contenidoTelefono === '') {
                 // Mostrar alerta si algún campo está vacío
                 Swal.fire({
                     icon: "error",
                     title: "Datos no insertados",
                     text: "Porfavor verifique los datos ingresados",
                 });
                 return; // Detener la ejecución si hay campos vacíos
             } else {
                 $.ajax({
                     url: './vistas/insertar_proveedor.php',
                     method: 'POST',
                     data: {
                         contenidoProveedor: contenidoProveedor,
                         contenidoPropietario: contenidoPropietario,
                         contenidoTelefono: contenidoTelefono,
                     },
                     success: function(response) {
                         console.log(response);

                         // Mostrar alerta y cerrar el modal si la inserción fue exitosa
                         if (response.includes('Inserción exitosa')) {
                             Swal.fire({
                                 title: "Datos insertados correctamente!",
                                 icon: "success"
                             }); // Aquí puedes agregar código para cerrar el modal
                             $("#mdlGestionarProveedor").modal(
                                 'hide'); // Reemplaza 'tuModal' con el ID de tu modal

                             $('#tbl_proveedores').DataTable().ajax.reload();


                             $("#iptProveedorReg").val('');
                             $("#iptPropietarioReg").val('');
                             $("#iptTelefonoReg").val('');



                             $("#validate_proveedor").css("display", "none");
                             $("#validate_propietario").css("display", "none");
                             $("#validate_telefono").css("display", "none");
                         } else {
                             // Manejar otros casos si es necesario
                         }
                     },
                     error: function(error) {
                         console.error(error);
                     }
                 });
             }

         });

     })
     </script>