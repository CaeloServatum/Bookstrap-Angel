<?php include 'codeEmpleados.php'; ?>

<?php include("../paginas/head.php") ?>

<div class="container">
    <div class="row">



        <!-- enctype="multipart/form-data" se utiliza para tratar la fotografia -->
        <form action="" method="post" enctype="multipart/form-data">



            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- cabecera del modal -->
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Datos Del Empleado</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Cuerpo del modal -->
                        <div class="modal-body">

                            <div class="form-row">

                                <div class="form-group col-md-12">
                                    <label for="id_empleado">Numero Documento</label>
                                    <input type="text" class="form-control" require name="id_empleado" id="id_empleado" placeholder="" value="<?php echo $id_empleado ?>">
                                    <br>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="nombre_empleado">Nombre(s)</label>
                                    <input type="text" class="form-control" require name="nombre_empleado" id="nombre_empleado" placeholder="" value="<?php echo $nombre_empleado ?>">
                                    <br>
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="apellido_empleado">Primer Apellido </label>
                                    <input type="text" class="form-control" require name="apellido_empleado" id="apellido_empleado" placeholder="" value="<?php echo $apellido_empleado ?>">

                                </div>

                                <div class="form-group col-md-12">
                                    <label for="correo_empleado">Correo </label>
                                    <input type="email" class="form-control" require name="correo_empleado" id="correo_empleado" placeholder="" value="<?php echo $correo_empleado ?>">

                                </div>



                                <div class="form-group col-md-12">
                                    <label for="foto">foto</label>
                                    <!-- El atributo accept image .... solo acepta formatos de imagen -->
                                    <input type="file" class="form-control" require accept="image/*" name="foto" id="foto" placeholder="" value="<?php echo $foto ?>">
                                    <br>
                                </div>



                            </div>
                        </div>

                        <!-- Pie/Footer del modal -->
                        <div class="modal-footer">

                            <button value="btnAgregar" class="btn btn-success" type="submit" name="accion">Agregar</button>
                            <button value="btnModificar" class="btn btn-warning" type="submit" name="accion">Modificar</button>
                            <button value="btnEliminar" class="btn btn-danger" type="submit" name="accion">Eliminar</button>
                            <button value="btnCancelar" class="btn btn-primary" type="submit" name="accion">Cancelar</button>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar Empleado
            </button>





        </form>
        <!-- Final del Formulario -->


        <div class="row">


            <table class="table table-hover table-bordered">

                <thead class="thead-dark">

                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Identificacion</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Correo</th>

                        <th scope="col">Seleccionar</th>
                        <th scope="col">Eliminar</th>
                    </tr>

                </thead>
                <tbody>

                    <?php
                    /* Prefunto que si la variable listaEmpleados tiene algun contenido */
                    if ($listaEmpleados->num_rows > 0) {

                        foreach ($listaEmpleados as $empleado) {

                    ?>

                            <tr>
                                <td>
                                    <img class="img-thumbnail" width="100px" src="../Imagenes/Empleados/<?php echo $empleado['foto']; ?>" />

                                </td>

                                <td> <?php echo $empleado['id_empleado']        ?> </td>
                                <td> <?php echo $empleado['nombre_empleado']    ?> </td>
                                <td> <?php echo $empleado['apellido_empleado'] ?> </td>
                                <td> <?php echo $empleado['correo_empleado']    ?> </td>



                                <form action="" method="post">

                                    <input type="hidden" name="id_empleado" value="<?php echo $empleado['id_empleado'];  ?>">
                                    <input type="hidden" name="nombre_empleado" value="<?php echo $empleado['nombre_empleado'];  ?>">
                                    <input type="hidden" name="apellido_empleado" value="<?php echo $empleado['apellido_empleado'];  ?>">
                                    <input type="hidden" name="correo_empleado" value="<?php echo $empleado['correo_empleado'];  ?>">
                                    <input type="hidden" name="foto" value="<?php echo $empleado['foto'];  ?>">

                                    <td><input type="submit" class="btn btn-info" value="Seleccionar"></td>
                                    <td><button value="btnEliminar" class="btn btn-danger" type="submit" name="accion">Eliminar</button></td>

                                </form>


                            </tr>


                    <?php

                        }
                    } else {

                        echo "<h2> No tenemos resultados </h2>";
                    }

                    ?>


                </tbody>
            </table>

        </div>


    </div>
</div>

<?php include("../paginas/footer.php") ?>