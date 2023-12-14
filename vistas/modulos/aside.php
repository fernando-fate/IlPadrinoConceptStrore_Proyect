<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" scroll-behavior: no;>
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="vistas/assets/imagenes/descarga.jpeg" alt="" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">PADRINO POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link active"
                        onclick="CargarContenido('vistas/dashboard.php','content-wrapper')">
                        <i class="fa-solid fa-chart-line fa-lg"></i>
                        <p>
                            Tablero Principal
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-cart-shopping fa-lg"></i>
                        <p>
                            Productos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link"
                                onclick="CargarContenido('vistas/productos.php','content-wrapper')">
                                <i class="fa-solid fa-box-archive fa-lg"></i>
                                <p>Inventario</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link"
                                onclick="CargarContenido('vistas/carga_masiva_productos.php','content-wrapper')">
                                <i class="fa-solid fa-upload fa-lg"></i>
                                <p>Carga Masiva</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link"
                                onclick="CargarContenido('vistas/categorias.php','content-wrapper')">
                                <i class="fa-solid fa-tag fa-lg"></i>
                                <p>Categorías</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link"
                        onclick="CargarContenido('vistas/proveedores.php','content-wrapper')">
                        <i class="fa-solid fa-user-tie"></i>
                        <p>
                            Proveedores
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link"
                        onclick="CargarContenido('vistas/ventas.php','content-wrapper')">
                        <i class="fa-solid fa-store fa-lg"></i>
                        <p>
                            Ventas
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link"
                        onclick="CargarContenido('vistas/reportes.php','content-wrapper')">
                        <i class="fa-solid fa-file-pdf fa-lg"></i>
                        <p>
                            Reportes
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link"
                        onclick="CargarContenido('vistas/configuracion.php','content-wrapper')">
                        <i class="fa-solid fa-gear fa-lg"></i>
                        <p>
                            Configuración
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link"
                        onclick="CargarContenido('vistas/administracion.php','content-wrapper')">
                        <i class="fa-solid fa-key"></i>
                        <p>
                            Administración
                        </p>
                    </a>
                </li>
                <!-- Opcion de menu para cerrar sesion -->
                <li class="nav-item">
                    
                    <a href="http://localhost/POS-main?cerrar_sesion=1" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Cerrar Sesion</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
$(".nav-link").on('click', function() {
    $(".nav-link").removeClass('active');
    $(this).addClass('active');
})
 </script>