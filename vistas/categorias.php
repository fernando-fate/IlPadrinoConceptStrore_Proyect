 <!-- Content Header (Page header) -->
 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">Productos / Categorias</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                     <li class="breadcrumb-item active">Productos / Categorias</li>
                 </ol>
             </div><!-- /.col -->
         </div><!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->


 <!-- Main content -->
 <div class="content">
     <div class="container-fluid">
         <!-- FILA PARA INPUT FILE -->
         <div class="row">
             <div class="col-lg-12">
                 <div class="card card-info">
                     <div class="card-header">
                         <h3 class="card-title">Seleccionar Archivo de Carga (Excel):</h3>
                         <div class="card-tools">
                             <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                 <i class="fas fa-minus"></i>
                             </button>
                         </div> <!-- ./ end card-tools -->
                     </div> <!-- ./ end card-header -->
                     <div class="card-body">
                         <form method="post" enctype="multipart/form-data" id="form_carga_productos">
                             <div class="row">
                                 <div class="col-lg-10">
                                     <input type="file" name="fileCategorias" id="fileCategorias" class="form-control"
                                         accept=".xls, .xlsx">
                                 </div>
                                 <div class="col-lg-2">
                                     <input type="submit" value="Cargar Categorias" class="btn btn-primary"
                                         id="btnCargar">
                                 </div>
                             </div>
                         </form>

                     </div> <!-- ./ end card-body -->
                 </div>
             </div>
         </div>

         <!-- FILA PARA IMAGEN DEL GIF -->
         <div class="row mx-0">
             <div class="col-lg-12 mx-0 text-center">
                 <img src="vistas\assets\imagenes\loading.gif" id="img_carga" style="display:none;">
             </div>
         </div>

         <div class="row">
             <div class="col-lg-12">
                 <table id=tbl_categorias class="table table-striped w-100 shadow ">
                     <thead class="bg-info">
                         <tr>
                             <th>Id</th>
                             <th>Categoria</th>
                             <th>N° Productos</th>
                             <th>Fecha Creacion</th>
                             <th>Fecha Modificacion</th>
                         </tr>
                     </thead>
                     <tbody>
                     </tbody>
                 </table>
             </div>
         </div>
         <!-- MODAL -->

         <div class="modal fade" id="mdlGestionarCategoria" role="dialog">
             <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                     <div class="modal-header bg-gradient-gray py-1 align-items-center">
                         <h5 class="modal-title">
                             Agregar Categoria
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
                                     <label class="" for="iptDescripcionReg"> <i class="fas fa-file-signature fs-6"></i>
                                         <span class="small">Descripcion</span><span class="text-danger">*</span>
                                     </label>
                                     <input type="text" class="form-control form-control-sm" id="iptDescripcionReg"
                                         name="iptDescripcionReg" placeholder="Descripcion" required>
                                     <span id="validate_descripcion" class="text-danger small fst-italic"
                                         style="display:none">Debe
                                         de Ingresar la descripcion de la categoria</span>
                                 </div>
                             </div>

                             <div class="d-flex">
                                 <button type="button" class="btn btn-danger mt-3 mx-2" style="width: 170px"
                                     data-bs-dismiss="modal" id="btnCancelarRegistro">Cancelar</button>
                                 <button type="button" class="btn btn-primary mt-3 mx-2" style="width: 170px"
                                     id="btnGuardarProducto" onclick="formSubmitClick()">Guardar Categoria</button>
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

             url: "ajax/categorias.ajax.php", //cambiar a categorias
             type: "POST",
             data: {
                 'accion': 1
             }, //listar categorias
             dataType: 'json',
             success: function(respuesta) {
                 console.log("respuesta", respuesta);
             }


         });

         table = $("#tbl_categorias").DataTable({
             dom: "Bfrtip",
             buttons: [{
                     text: '<i class="fa-regular fa-square-plus fa-xl"></i> Agregar Categoria',
                     className: 'addNewRecord',
                     action: function(e, dt, node, config) {
                         $("#mdlGestionarCategoria").modal('show');

                     }
                 },
                 {
                     extend: 'excel',
                     text: '<i class="fa fa-file-excel"></i> Exportar Excel'
                 },
                 /*{
                     extend: 'print',
                     text: '<i class="fa fa-print"></i> Imprimir',
                     'customize': function(win) {
                         // Agregar una imagen personalizada al encabezado de la página de impresión
                         var header = win.document.createElement('div');
                         header.style.textAlign = 'center';
                         header.innerHTML =
                             '<img src="https://static.wixstatic.com/media/0c0d0c_ff63f0d708c243b3b9d5c7b4e2d2f6de~mv2.png" style="width: 200px; height: auto">';
                         win.document.body.insertBefore(header, win.document.body.firstChild);
                     }
                 }*/
                 /*{
                     extend: 'print',
                     text: '<i class="fa fa-print"></i> Imprimir',
                     customize: function(win) {
                         // Agregar una imagen personalizada al encabezado de la página de impresión
                         var header = win.document.createElement('div');
                         header.style.textAlign = 'center';
                         header.innerHTML =
                             '<img src="https://static.wixstatic.com/media/0c0d0c_ff63f0d708c243b3b9d5c7b4e2d2f6de~mv2.png" style="width: 200px; height: auto">';
                         win.document.body.insertBefore(header, win.document.body.firstChild);

                         // Agregar la fecha de generación en la parte superior derecha
                         var date = new Date().toLocaleDateString();
                         var pageInfo = win.document.createElement('div');
                         pageInfo.style.textAlign = 'right';
                         pageInfo.innerHTML = 'Fecha de Generación: ' + date;
                         header.appendChild(pageInfo);
                     },
                     exportOptions: {
                         columnscolumns: [1, 2,3,4,5,6,7,8,9]  // Imprimir solo las columnas visibles
                     }
                 }*/
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
                     action: function(e, dt, node, config) {
                         $('#tbl_proveedores').DataTable().ajax.reload();
                     }
                 },
                 'pageLength'
             ],
             pageLength: [1, 5, 10, 15, 30, 50, 100],
             pageLength: 10,
             ajax: {
                 url: "ajax/categorias.ajax.php",
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
         $("#form_carga_productos").on('submit', function(e) {

             e.preventDefault();

             /*===================================================================*/
             //VALIDAR QUE SE SELECCIONE UN ARCHIVO
             /*===================================================================*/
             if ($("#fileCategorias").get(0).files.length == 0) {
                 Swal.fire({
                     position: 'center',
                     icon: 'warning',
                     title: 'Debe seleccionar un archivo (Excel).',
                     showConfirmButton: false,
                     timer: 2500
                 })
             } else {

                 /*===================================================================*/
                 //VALIDAR QUE EL ARCHIVO SELECCIONADO SEA EN EXTENSION XLS O XLSX
                 /*===================================================================*/
                 var extensiones_permitidas = [".xls", ".xlsx"];
                 var input_file_productos = $("#fileCategorias");
                 var exp_reg = new RegExp("([a-zA-Z0-9\s_\\-.\:])+(" + extensiones_permitidas.join(
                     '|') +
                     ")$");

                 if (!exp_reg.test(input_file_productos.val().toLowerCase())) {
                     Swal.fire({
                         position: 'center',
                         icon: 'warning',
                         title: 'Debe seleccionar un archivo con extensión .xls o .xlsx.',
                         showConfirmButton: false,
                         timer: 2500
                     })

                     return false;
                 }

                 var datos = new FormData($(form_carga_productos)[0]);

                 $("#btnCargar").prop("disabled", true);
                 $("#img_carga").attr("style", "display:block");
                 $("#img_carga").attr("style", "height:200px");
                 $("#img_carga").attr("style", "width:200px");

                 $.ajax({
                     url: "ajax/categorias.ajax.php", //cambiar a categorias
                     type: "POST",
                     data: datos,
                     cache: false,
                     contentType: false,
                     processData: false,
                     dataType: 'json',
                     success: function(respuesta) {

                         // console.log("respuesta",respuesta);

                         if (respuesta['totalCategorias'] > 0 || respuesta[
                             'totalProductos'] >
                             0) {

                             Swal.fire({
                                 position: 'center',
                                 icon: 'success',
                                 title: 'Se registraron ' + respuesta[
                                         'totalCategorias'] +
                                     ' Categorias correctamente!',
                                 showConfirmButton: false,
                                 timer: 3500
                             })

                             $("#btnCargar").prop("disabled", false);
                             $("#img_carga").attr("style", "display:none");
                         } else {

                             Swal.fire({
                                 position: 'center',
                                 icon: 'error',
                                 title: 'Se presento un error al momento de realizar el registro de categorías!',
                                 showConfirmButton: false,
                                 timer: 2500
                             })

                             $("#btnCargar").prop("disabled", false);
                             $("#img_carga").attr("style", "display:none");

                         }
                     }
                 });

             }
         })


         $("#btnCerrarModal,#btnCancelarRegistro").on("click", function() {
             /* $("#iptCodigoReg").val('');
              $("#selCategoriaReg").val('');*/
             $("#iptDescripcionReg").val('');
             /* $("#iptProveedorReg").val('');
              $("#iptPrecioVentaReg").val('');
              $("#iptStockReg").val('');*/

             /*$("#validate_codigo").css("display", "none");
             $("#validate_categoria").css("display", "none");*/
             $("#validate_descripcion").css("display", "none");
             /* $("#validate_stock").css("display", "none");
              $("#validate_precio_venta").css("display", "none");
              $("#validate_proveedor").css("display", "none");*/
         })

         $("#btnGuardarProducto").on("click", function() {
             // Obtener los valores de los campos
             /* var contenidoCodigo = $("#iptCodigoReg").val();
              var contenidoCategoria = $("#selCategoriaReg option:selected").text();*/
             var contenidoDescripcion = $("#iptDescripcionReg").val();
             /*var contenidoProveedor = $("#iptProveedorReg option:selected").text();
             var contenidoPrecioVenta = $("#iptPrecioVentaReg").val();
             var contenidoStock = $("#iptStockReg").val();*/



             // Validar que todos los campos estén llenos
             if (contenidoDescripcion === '') {
                 // Mostrar alerta si algún campo está vacío
                 Swal.fire({
                     icon: "error",
                     title: "Datos no insertados",
                     text: "Porfavor verifique los datos ingresados",
                 });
                 return; // Detener la ejecución si hay campos vacíos
             } else {
                 $.ajax({
                     url: './vistas/insertar_categoria.php',
                     method: 'POST',
                     data: {
                         /*contenidoCodigo: contenidoCodigo,
                         contenidoCategoria: contenidoCategoria,*/
                         contenidoDescripcion: contenidoDescripcion,
                         /* contenidoProveedor: contenidoProveedor,
                          contenidoPrecioVenta: contenidoPrecioVenta,
                          contenidoStock: contenidoStock*/
                     },
                     success: function(response) {
                         console.log(response);

                         // Mostrar alerta y cerrar el modal si la inserción fue exitosa
                         if (response.includes('Inserción exitosa')) {
                             Swal.fire({
                                 title: "Datos insertados correctamente!",
                                 icon: "success"
                             }); // Aquí puedes agregar código para cerrar el modal
                             $("#mdlGestionarCategoria").modal(
                                 'hide'); // Reemplaza 'tuModal' con el ID de tu modal


                             /* $("#iptCodigoReg").val('');
                              $("#selCategoriaReg").val('');*/
                             $("#iptDescripcionReg").val('');
                             /* $("#iptProveedorReg").val('');
                              $("#iptPrecioVentaReg").val('');
                              $("#iptStockReg").val('');*/

                             /* $("#validate_codigo").css("display", "none");
                              $("#validate_categoria").css("display", "none");*/
                             $("#validate_descripcion").css("display", "none");
                             /* $("#validate_stock").css("display", "none");
                              $("#validate_precio_venta").css("display", "none");
                              $("#validate_proveedor").css("display", "none");*/


                             $('#tbl_categorias').DataTable().ajax.reload();


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