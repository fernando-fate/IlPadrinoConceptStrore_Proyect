<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Inventario / Productos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Inventario / Productos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <!-- row para criterio de busqueda  -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Criterios de Busqueda</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" id="btnLimpiarBusqueda">
                                <i class='fas fa-times'></i>
                            </button>
                        </div> <!-- ./ end card-tools -->
                    </div> <!-- ./ end card-header -->
                    <div class="card-body">
                        <div class="row">

                            <div class="col-lg-12 d-lg-flex">
                                <div style="width:20%" class=" form-floating mx-1">
                                    <input type="text" id="iptCodigoBarras" class="form-control" data-index="2">
                                    <label for="iptCodigoBarras">Codigo de Barras</label>
                                </div>

                                <div style="width:20%" class=" form-floating mx-1">
                                    <input type="text" id="iptCategoria" class="form-control" data-index="3">
                                    <label for="iptCategoria">Categoria</label>
                                </div>

                                <div style="width:20%" class=" form-floating mx-1">
                                    <input type="text" id="iptProducto" class="form-control" data-index="4">
                                    <label for="iptProducto">Producto</label>
                                </div>

                                <div style="width:20%" class=" form-floating mx-1">
                                    <input type="text" id="iptPrecioVentaDesde" class="form-control" data-index="5">
                                    <label for="iptPrecioVentaDesde">Proveedor</label>
                                </div>
                                <!-- ./ end card-header 
                                <div style="width:20%" class=" form-floating mx-1">
                                    <input type="text" id="Proveedor" class="form-control" data-index="6">
                                    <label for="iptProveedor">P. de Venta desde</label>
                                </div>-->



                            </div>
                        </div>
                    </div> <!-- ./ end card-body -->
                </div>
            </div>

        </div>
        <!-- cierre row criterio de busqueda -->

        <div class="row">
            <div class="col-lg-12">
                <table id=tbl_productos class="table table-striped w-100 shadow">
                    <thead class="bg-info">
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Codigo</th>
                            <th>Categoria</th>
                            <th>Producto</th>
                            <th>Proveedor</th>
                            <th>P.Venta</th>
                            <th>Stock</th>
                            <th>MinStock</th>
                            <th>Ventas</th>
                            <th>Fecha Creacion</th>
                            <th>Fecha Actualizacion</th>
                            <th class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- MODAL PARA AGREGAR PRODUCTO -->
<div class="modal fade" id="mdlGestionarProducto" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-gray py-1 align-items-center">
                <h5 class="modal-title">
                    Agregar Producto
                </h5>
                <button type="button" class="btn btn-outline-primary text-white border-0 fs-5" id="btnCerrarModal"
                    data-bs-dismiss="modal">
                    <i class="far fa-times-circle"> </i>
                </button>
            </div>
            <div class="modal-body ">
                <div class="row ">

                    <!-- Codigo de Barras -->
                    <div class="col-lg-6">
                        <div class="form-group mb-2">
                            <label class="" for="iptCodigoReg"> <i class="fas fa-barcode fs-6"></i>
                                <span class="small">Codigo de Barras</span><span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-sm" id="iptCodigoReg"
                                name="iptCodigoReg" placeholder="Codigo de Barras" required>
                            <span id="validate_codigo" class="text-danger small fst-italic" style="display:none">Debe
                                de Ingresar el Codigo de Barras</span>
                        </div>


                    </div>

                    <!-- Categoria -->
                    <div class="col-lg-6">
                        <div class="form-group mb-2">
                            <label class="" for="selCategoriaReg"> <i class="fas fa-dumpster fs-6"></i>
                                <span class="small">Categoria</span><span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                id="selCategoriaReg">
                                <?php
                                    // Conexión a la base de datos
                                    $conexion = new PDO("mysql:host=localhost;dbname=market-pos","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                                    // Consulta para obtener categorías
                                    $query = $conexion->prepare("SELECT id_categoria, nombre_categoria FROM categorias group by nombre_categoria asc");
                                    $query->execute();

                                    // Obtener resultados como un array asociativo
                                    $categorias = $query->fetchAll(PDO::FETCH_ASSOC);

                                    // Iterar sobre las categorías y agregarlas al ComboBox
                                    foreach ($categorias as $categoria) {
                                        echo "<option value='{$categoria['id_categoria']}'>{$categoria['nombre_categoria']}</option>";
                                    }
                                ?>
                            </select>
                            <span id="validate_categoria" class="text-danger small fst-italic" style="display:none">Debe
                                de Ingresar la categoria del producto</span>
                        </div>
                    </div>
                </div>

                <!-- Descripcion -->


                <div class="col-lg-12">
                    <div class="form-group mb-2">
                        <label class="" for="iptDescripcionReg"> <i class="fas fa-file-signature fs-6"></i>
                            <span class="small">Descripcion</span><span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-sm" id="iptDescripcionReg"
                            name="iptDescripcionReg" placeholder="Descripcion" required>
                        <span id="validate_descripcion" class="text-danger small fst-italic" style="display:none">Debe
                            de Ingresar la descripcion del producto</span>
                    </div>
                </div>

                <!-- Proveedor -->
                <div class="col-lg-12">
                    <div class="form-group mb-2">
                        <label class="" for="iptProveedorReg"> <i class="fa-solid fa-user-tie fa-sm"></i>
                            <span class="small">Proveedor</span><span class="text-danger">*</span>
                        </label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                            id="iptProveedorReg">

                            <?php
                                    // Conexión a la base de datos
                                    $conexion = new PDO("mysql:host=localhost;dbname=market-pos","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                                    // Consulta para obtener categorías
                                    $query = $conexion->prepare("SELECT id_proveedor, nombre_proveedor FROM proveedor group by nombre_proveedor asc");
                                    $query->execute();

                                    // Obtener resultados como un array asociativo
                                    $proveedores = $query->fetchAll(PDO::FETCH_ASSOC);

                                    // Iterar sobre las categorías y agregarlas al ComboBox
                                    foreach ($proveedores as $proveedor) {
                                        echo "<option value='{$proveedor['id_proveedor']}'>{$proveedor['nombre_proveedor']}</option>";
                                    }
                                ?>
                        </select>
                        <span id="validate_proveedor class=" text-danger small fst-italic" style="display:none">Debe de
                            Ingresar el proveedor del producto</span>
                    </div>
                </div>

                <!-- Precio -->

                <div class="col-lg-4">
                    <div class="form-group mb-2">
                        <label class="" for="iptPrecioVentaReg"> <i class="fas fa-dollar-sign fs-6"></i>
                            <span class="small">Precio de Venta</span><span class="text-danger"></span>
                        </label>
                        <input type="number" min="0" class="form-control form-control-sm" id="iptPrecioVentaReg"
                            name="iptPrecioVentaReg" placeholder="Precio de Venta" required>
                        <span id="validate_precio_venta" class="text-danger small fst-italic" style="display:none">Debe
                            de Ingresar el precio de venta del producto</span>
                    </div>
                </div>
                <!-- Stock -->

                <div class="col-lg-4">
                    <div class="form-group mb-2">
                        <label class="" for="iptStockReg"> <i class="fa-regular fa-square-plus fs-6"></i>
                            <span class="small">Stock</span><span class="text-danger">*</span>
                        </label>
                        <input type="number" min="0" class="form-control form-control-sm" id="iptStockReg"
                            name="iptStockReg" placeholder="Stock" required>
                        <span id="validate_stock" class="text-danger small fst-italic" style="display:none">Debe
                            de Ingresar el stock del producto</span>
                    </div>
                </div>

                <div class="d-flex">
                    <button type="button" class="btn btn-danger mt-3 mx-2" style="width: 170px" data-bs-dismiss="modal"
                        id="btnCancelarRegistro">Cancelar</button>
                    <button type="button" class="btn btn-primary mt-3 mx-2" style="width: 170px" id="btnGuardarProducto"
                        onclick="formSubmitClick()">Guardar Producto</button>
                </div>



            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {




    var table;

    $.ajax({

        url: "ajax/productos.ajax.php", //cambiar a categorias
        type: "POST",
        data: {
            'accion': 1
        }, //listar productos
        dataType: 'json',
        success: function(respuesta) {
            console.log("respuesta", respuesta);
        }


    });



    table = $("#tbl_productos").DataTable({
        dom: "Bfrtip",
        buttons: [{
                text: '<i class="fa-regular fa-square-plus fa-xl"></i> Agregar Producto',
                className: 'addNewRecord',
                action: function(e, dt, node, config) {
                    $("#mdlGestionarProducto").modal('show');
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
                    win.document.body.insertBefore(header, win.document.body
                        .firstChild);
                },
                exportOptions: {
                    columns: ':visible' // Imprimir solo las columnas visibles
                }
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
            url: "ajax/productos.ajax.php",
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

        columnDefs: [{
                targets: 0,
                orderable: false,
                className: 'control'
            }, {
                targets: 4,

                className: 'text-center'
            },
            {
                targets: 7, //columna de stock
                createdCell: function(td, cellData, rowData, row, col) {
                    if (parseFloat(rowData[7]) == 0.00) { //columna de stock
                        $(td).parent().css('background', '#eb5121')
                    }

                }
            },
            {
                targets: 12, //columna de los botones
                orderable: false,
                'render': function(data, type, full, meta) {
                    return "<center>" +
                        "<span class='btnEditarProducto text-primary px-1'>" +
                        "<i class='fa fa-edit' style='cursor:pointer'></i>" +

                        "<span class='btnMasStockProducto text-warning px-1'>" +
                        "<i class='fa-solid fa-plus' style='cursor:pointer'></i>" +

                        "<span class='btnMenosStockProducto text-success px-1'>" +
                        "<i class='fa-solid fa-minus' style='cursor:pointer'></i>" +

                        "<span class='btnEliminarProducto text-danger px-1'>" +
                        "<i class='fa fa-trash' style='cursor:pointer'></i>" +
                        "</center>";
                }
            },
            {
                targets: 9, //columna de ventas
                visible: false
            },
            {
                targets: 8, //columna de min stock
                visible: false
            }


        ],

        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        }
    });

    $("#iptCodigoBarras").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    $("#iptCategoria").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    $("#iptProducto").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })
    $("#iptProveedor").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    $("#iptPrecioVentaDesde").keyup(function() {
        table.column($(this).data('index')).search(this.value).draw();
    })

    $("#btnLimpiarBusqueda").on('click', function() {
        $("#iptCodigoBarras").val('');
        $("#iptCategoria").val('');
        $("#iptProducto").val('');
        $("#iptProveedor").val('');
        $("#iptPrecioVentaDesde").val('');

        table.search('').columns().search('').draw();
    })

    $("#btnCerrarModal,#btnCancelarRegistro").on("click", function() {
        $("#iptCodigoReg").val('');
        $("#selCategoriaReg").val('');
        $("#iptDescripcionReg").val('');
        $("#iptProveedorReg").val('');
        $("#iptPrecioVentaReg").val('');
        $("#iptStockReg").val('');

        $("#validate_codigo").css("display", "none");
        $("#validate_categoria").css("display", "none");
        $("#validate_descripcion").css("display", "none");
        $("#validate_stock").css("display", "none");
        $("#validate_precio_venta").css("display", "none");
        $("#validate_proveedor").css("display", "none");
    })

    $("#btnGuardarProducto").on("click", function() {
        // Obtener los valores de los campos
        var contenidoCodigo = $("#iptCodigoReg").val();
        var contenidoCategoria = $("#selCategoriaReg option:selected").text();
        var contenidoDescripcion = $("#iptDescripcionReg").val();
        var contenidoProveedor = $("#iptProveedorReg option:selected").text();
        var contenidoPrecioVenta = $("#iptPrecioVentaReg").val();
        var contenidoStock = $("#iptStockReg").val();



        // Validar que todos los campos estén llenos
        if (contenidoCodigo === '' || contenidoCategoria === '' || contenidoDescripcion === '' ||
            contenidoProveedor === '' || contenidoPrecioVenta === '' || contenidoStock === '') {
            // Mostrar alerta si algún campo está vacío
            Swal.fire({
                icon: "error",
                title: "Datos no insertados",
                text: "Porfavor verifique los datos ingresados",
            });
            return; // Detener la ejecución si hay campos vacíos
        } else {
            $.ajax({
                url: './vistas/insertar_producto.php',
                method: 'POST',
                data: {
                    contenidoCodigo: contenidoCodigo,
                    contenidoCategoria: contenidoCategoria,
                    contenidoDescripcion: contenidoDescripcion,
                    contenidoProveedor: contenidoProveedor,
                    contenidoPrecioVenta: contenidoPrecioVenta,
                    contenidoStock: contenidoStock
                },
                success: function(response) {
                    console.log(response);

                    // Mostrar alerta y cerrar el modal si la inserción fue exitosa
                    if (response.includes('Inserción exitosa')) {
                        Swal.fire({
                            title: "Datos insertados correctamente!",
                            icon: "success"
                        }); // Aquí puedes agregar código para cerrar el modal
                        $("#mdlGestionarProducto").modal(
                            'hide'); // Reemplaza 'tuModal' con el ID de tu modal


                        $("#iptCodigoReg").val('');
                        $("#selCategoriaReg").val('');
                        $("#iptDescripcionReg").val('');
                        $("#iptProveedorReg").val('');
                        $("#iptPrecioVentaReg").val('');
                        $("#iptStockReg").val('');

                        $("#validate_codigo").css("display", "none");
                        $("#validate_categoria").css("display", "none");
                        $("#validate_descripcion").css("display", "none");
                        $("#validate_stock").css("display", "none");
                        $("#validate_precio_venta").css("display", "none");
                        $("#validate_proveedor").css("display", "none");


                        $('#tbl_productos').DataTable().ajax.reload();


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