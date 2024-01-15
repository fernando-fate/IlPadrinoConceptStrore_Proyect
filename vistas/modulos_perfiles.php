<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Administrar Modulos y Perfiles</h1>
            </div><!--/.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Modulos y Perfiles</li>
                </ol>
            </div><!--/.col -->
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <ul class="nav nav-tabs" id="tabs-asignar-modulos-perfil" role="tablist">
            <li class="nav-item">
                <a href="#content-perfiles" class="nav-link" id="content-perfiles-tab" data-toggle="pill" role="tab" aria-controls="content-perfiles" aria-selected="false">Perfiles</a>
            </li>
            <li class="nav-item">
            <a href="#content-modulos" class="nav-link" id="content-modulos-tab" data-toggle="pill" role="tab" aria-controls="content-modulos" aria-selected="false">Modulos</a>
            </li>
            <li class="nav-item">
            <a href="#content-modulo-perfil" class="nav-link active" id="content-modulo-perfil-tab" data-toggle="pill" role="tab" aria-controls="content-modulo-perfil" aria-selected="false">Asignar Modulos a Perfil</a>
            </li>

        </ul>

        <div class="tab-content" id="tabsContent-asignar-modulos-perfil">
            <div class="tab-pane fade mt-4 px-4" id="content-perfiles" role="tabpanel" aria-labelledby="content-perfiles-tab">
                <h4>Administrar Perfiles</h4>
            </div>

            <div class="tab-pane fade mt-4 px-4" id="content-modulos" role="tabpanel" aria-labelledby="content-modulos-tab">
                <h4>Administrar Modulos</h4>
            </div>

            <div class="tab-pane fade active show mt-4 px-4" id="content-modulo-perfil" role="tabpanel" aria-labelledby="content-modulo-perfil-tab">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-info card-outline shadow">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-laptop"></i>Listado de perfiles</h3>
                            </div>
                            <div class="card-body">
                                <table id="tbl_perfiles_asignar" class="display nowrap table-striped w-100 shadow rounded">
                                    <thead class="bg-info text-left">
                                        <th>id Perfil</th>
                                        <th>Perfil</th>
                                        <th>Estado</th>
                                        <th>F. Creacion</th>
                                        <th>F. Actualizacion</th>
                                        <th class="text-center">Opciones</th>
                                    </thead>
                                    <tbody class="small text left">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="card card-info card-outline shadow" style="display:none" id="card-modulos">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-laptop"></i>Modulos del Sistema</h3>
                            </div>
                            <div class="card-body" id="card-body-modulos">
                                <div class="row m-2">
                                    <div class="col-md-6">
                                        <button class="btn btn-success btn-small m-0 p-0 w-100" id="marcar_modulos">Marcar toto</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger btn-small m-0 p-0 w-100" id="desmarcar_modulos">Desmarcar todo</button>
                                    </div>
                                </div>
                                <!-- Aqui se cargan todos los modulos del sistema -->
                                <div class="demo" id="modulos"><!--se carga con js tree-->
                                    
                                </div>
                                <div class="row m-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Seleccione el modulo de inicio</label>
                                            <select name="" id="select_modulos" class="custom-select">
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-success btn-small w-50 text-center" id="asignar_modulos">Asignar</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        var tbl_perfiles_asignar, modulos_usuario, modulos_sistemas;

        /* ===========================================================
        VARIABLES PARA REGISTRAR EL PERFIL Y LOS MODULOS SELECCIONADOS
        ============================================================== */
        var idPerfil = 0;
        var selectedElmsIds = [];
        /* =========================================================
        EVENTO PARA SELECCIONAR UN PERFIL DEL DATATABLE Y MOSTRAR LOS MODULOS ASIGNADOS EN EL ARBOL DE MODULOS
        =======================================================*/
        $('#tbl_perfiles_asignar tbody').on('click', '.btnSeleccionarPerfil', function(){
            var data = tbl_perfiles_asignar.row($(this).parents('tr')).data();
            if($(this).parents('tr').hasClass('selected')){
                $(this).parents('tr').removeClass('selected');

                $('#modulos').jstree("deselect_all");
                $('#select_modulos option').remove();

                $('#select_modulos').append($('<option>', {
                        value: 0,
                        text: 'Seleccione un modulo'
                    }));
                idPerfil = 0;

            }
            else{
                tbl_perfiles_asignar.$('tr.selected').removeClass('selected');
                $(this).parents('tr').addClass('selected');

                idPerfil = data[0];
                $('#card-modulos').css("display", "block");
                
                $.ajax({
                    async:false,
                    url:'ajax/modulo.ajax.php',
                    method:'POST',
                    data:{
                        accion: 2,
                        id_Perfil: idPerfil
                    },
                    dataType:'json',
                    success:function(respuesta){
                        modulos_usuario = respuesta;
                        seleccionarModulosPerfil(idPerfil);
                        
                    }
                })

            }
        })
        /*======================================================
        EVENTO QUE SE DISPARA CADA VEZ QUE HAY UN CAMBIO EN EL ARBOL DE MODULOS
        ====================================================== */

        $('#modulos').on("changed.jstree",
            function(evt, data){
                $('#select_modulos option').remove();


                var selectedElmsIds = $('#modulos').jstree("get_selected", true);
                console.log(selectedElmsIds);
                $.each(selectedElmsIds, function(){
                    for(let i=0; i < modulos_sistema.length; i++){
                        if(modulos_sistema[i]["id"] == this["id"] && modulos_sistema[i]["vista"]){
                            $('#select_modulos').append($('<option>', {
                                value: this.id,
                                text: this.text
                            }));
                        }
                    }
                })

                if($("#select_modulos").has('option').length <= 0){
                    $('#select_modulos').append($('<option>', {
                        value: 0,
                        text: 'Seleccione un modulo'
                    }));
                }

            }
        )
        /* ===========================================================
        EVENTO PARA MARCAR TODOS LOS CHECKBOX DEL ARBOL DE MODULOS
        ============================================================== */
        $('#marcar_modulos').on('click', function(){
            $('#modulos').jstree("select_all");
        })
        /* ===========================================================
        EVENTO PARA DESMARCAR TODOS LOS CHECKBOX DEL ARBOL DE MODULOS
        ============================================================== */
        $('#desmarcar_modulos').on('click', function(){
            $('#modulos').jstree("deselect_all");
            $('#select_modulos option').remove();

            $('#select_modulos').append($('<option>', {
                value: 0,
                text: 'Seleccione un modulo'
            }));
        })

        /* ===========================================================
        REGISTRO EN BASE DE DATOS DE LOS MODULOS ASOCIADOS AL PERFIL
        ============================================================== */
        $("#asignar_modulos").on('click', function(){
            selectedElmsIds = [];
            var selectedElms =$('#modulos').jstree("get_selected", true);

            $.each(selectedElms, function(){
                selectedElmsIds.push(this.id);
                
                if(this.parent != '#'){
                    selectedElmsIds.push(this.parent);
                }
            })

            let modulosSeleccionados = [...new Set(selectedElmsIds)]
            let modulo_inicio = $('#select_modulos').val();

            if(idPerfil != 0 && modulosSeleccionados.length > 0){
                console.log(modulosSeleccionados);
                registrarPerfilModulos(modulosSeleccionados, idPerfil, modulo_inicio);
            }else{
                Swal.fire({
                    position:'center',
                    title: 'Debe seleccionar el perfil y modulos a registrar',
                    //text: 'Debe seleccionar un perfil y al menos un modulo',
                    icon: 'warning',
                    showConfirmButton: false,
                    timer:3000
                })
            }
        })
        /* ===========================================================
        Funciones para las cargas iniciales de datatables, arbol de modulos y reajustes de cabeceras de datatables
        ============================================================== */
        cargarDataTables();

        iniciarArbolModulos();


        function cargarDataTables(){
            tbl_perfiles_asignar = $('#tbl_perfiles_asignar').DataTable({
                ajax:{
                    async:false,
                    url:'ajax/perfil.ajax.php',
                    type:'POST',
                    dataType: 'json',
                    dataSrc:"",
                    data:{
                        accion:1
                    }
                },
                columnDefs: [
                    {
                        targets:2,
                        sortable:false,
                        createdCell: function(td, cellData, rowData, row, col){
                            if(parseInt(rowData[2]) == 1){
                                $(td).html("Activo")
                            }
                            else{
                                $(td).html("Inactivo")
                            }
                        }
                    },
                    {
                        targets:5,
                        sortable: false,
                        render: function(data, type, full, meta){
                            return  "<center>"+
                                        "<span class='btnSeleccionarPerfil text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip'" +
                                        "data-bs-placement='top' title='Seleccionar perfil'>"+
                                        "<i class='fas fa-check fs-5'></i>"+
                                        "</span>" +
                                    "</center>";
                        }
                    }
                ]
                ,
                language:{
                    "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
                }
            })

            $('#select_modulos').append($('<option>', {
                value: 0,
                text: 'Seleccione un modulo'
            }));
        }

        function iniciarArbolModulos(){
            $.ajax({
                async: false,
                url: "ajax/modulo.ajax.php",
                method: 'POST',
                data:{
                    accion: 1
                },
                dataType:'json',
                success: function(respuesta){
                    // console.log(respuesta)
                    modulos_sistema = respuesta;

                     //inline data demo
                    $('#modulos').jstree({
                        'core' : {
                            "check_callback" : true,
                            'data' : respuesta
                        },
                        'checkbox' : {
                            'keep_selected_style' : true
                        },
                        'types':{
                            'default':{
                                'icon': 'fas fa-laptop text-warning'
                            }
                        },
                        "plugins" : [ "wholerow", "checkbox", "types", "changed" ]
                    }).bind("loades.jstree", function(event, data){
                        $(this).jstree("open_all");
                    });
                }
            })
        }

        function seleccionarModulosPerfil(pin_idPerfil){
            $('#modulos').jstree("deselect_all");
            // $('#select_modulos option').remove();

            // console.info('Modulos del usuario',modulos_usuario);
            // console.info('Modulos del sistema',modulos_sistema);

            $('#select_modulos').append('<option value="0">Seleccione un modulo</option>');

            for(let i = 0; i< modulos_sistema.length; i++){
                if(modulos_sistema[i]["id"] == modulos_usuario[i]["id"] && modulos_usuario[i]["sel"] == 1){
                    //se seleccionan las opciones del arbol de modulos
                    $('#modulos').jstree("select_node", modulos_sistema[i]["id"]);
                    
                    // $('#select_modulos').append('<option value="'+modulos_sistema[i]["id"]+'">'+modulos_sistema[i]["text"]+'</option>')
                }
            }

            /*OCULTAMOS LA OPCION DE MODULOS Y PERFILES PARA EL PERFIL DE ADMINISTRADOR */
            if(pin_idPerfil == 1){ //SOLO PERFIL ADMINISTRADOR
                $("#modulos").jstree(true).hide_node(13);
            }else{
                $("#modulos").jstree(true).show_all();
            
            }
            // $('#select_modulos').val(pin_idPerfil);
        }

        function registrarPerfilModulos(modulosSeleccionados, idPerfil, idModulo_inicio){
            $.ajax({
                async: false,
                url: "ajax/perfil_modulo.ajax.php",
                method: 'POST',
                data: {
                    accion: 1,
                    id_modulosSeleccionados: modulosSeleccionados,
                    id_Perfil: idPerfil,
                    idModulo_inicio: idModulo_inicio
                },
                dataType: "json",
                success: function (respuesta) {
                    console.log('La respuesta',respuesta);
                    if(respuesta > 0){
                        Swal.fire({
                            position:'center',
                            title: 'Se han registrado los modulos correctamente',
                            icon: 'success',
                            showConfirmButton: false,
                            timer:2000
                        })

                        $('#select_modulos option').remove();
                        $('#modulos').jstree("deselect_all", false);
                        tbl_perfiles_asignar.ajax.reload();
                        $('#card-modulos').css("display", "none");
                    }
                    else{
                        Swal.fire({
                            position:'center',
                            title: 'No se han registrado los modulos',
                            icon: 'error',
                            showConfirmButton: false,
                            timer:3000
                        })
                    }
                }
            });
        }
    })
</script>