<!-- Instrucciones de uso  https://sweetalert.js.org/guides/#installation -->
<script src="../js/sweetalert.js"></script>

<?php
//incluimos la conexion a la base de datos 
include("../Conexion/conexion.php");


//Recibimos las variables enviadas
$id_empleado = (isset($_POST['id_empleado'])) ? $_POST['id_empleado'] : "";
$nombre_empleado = (isset($_POST['nombre_empleado'])) ? $_POST['nombre_empleado'] : "";
$apellido_empleado = (isset($_POST['apellido_empleado'])) ? $_POST['apellido_empleado'] : "";
$correo_empleado = (isset($_POST['correo_empleado'])) ? $_POST['correo_empleado'] : "";


$foto = (isset($_FILES['foto']["name"])) ? $_FILES['foto']["name"] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";


switch ($accion) {
    case 'btnAgregar':



        $fecha = new DateTime();
        //Se crea el nombre de la imagen.... si no tenemos fotos por defecto toma imagen.jpg
        $nombreFoto = ($foto != "") ? $fecha->getTimestamp() . "_" . $_FILES["foto"]["name"] : "imagen.jpg";

        $nombreFoto = $foto;

        //nombre que devuelve PHP de la imagen
        $tmpFoto = $_FILES["foto"]["tmp_name"];

        if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            // Continuar con el proceso de carga y almacenamiento de la imagen.


            if ($tmpFoto != "") {
                /* Movemos el archivo a la carpeta imagenes  */
                move_uploaded_file($tmpFoto, "../Imagenes/Empleados/" . $nombreFoto);


                /* la variable sentencia recolecta la informacion del formulario y 
                la envia a la base de datos.
                La variable conn nos brinda la conexion a la base de datos.
                ->prepare nos prepara la sentencia SQL para que inyecte los valores a la BD.
                */
                $insercionEmpleados = $conn->prepare(
                    "INSERT INTO empleados( id_empleado, nombre_empleado, apellido_empleado, 
                correo_empleado, foto) 
                VALUES ('$id_empleado','$nombre_empleado','$apellido_empleado','$correo_empleado','$foto')"
                );



                $insercionEmpleados->execute();
                $conn->close();
               
               echo" <script>
                    swal('Mensaje Principal!', 'Mensaje segundario!', 'success');
                    </script>";
                

                header('location: index.php');
            } else {
                echo "Problemas";
            }
        } else {
            // Manejar el error de carga de la imagen.
            echo "Error al cargar la imagen: " . $_FILES['foto']['error'];
        }




        break;

    case 'btnModificar':

        $editarEmpleados = $conn->prepare(" UPDATE empleados SET nombre_empleado = '$nombre_empleado' , 
        apellido_empleado = '$apellido_empleado', correo_empleado = '$correo_empleado'
        WHERE id_empleado = '$id_empleado' ");

        /* Aca solo esta actualizando la fotografia */
        $editarEmpleadosFoto = $conn->prepare(" UPDATE empleados SET  foto = '$foto'
        WHERE id_empleado = '$id_empleado' ");


        $fecha = new DateTime();
        //Se crea el nombre de la imagen.... si no tenemos fotos por defecto toma imagen.jpg
        $nombreFoto = ($foto != "") ? $fecha->getTimestamp() . "_" . $_FILES["foto"]["name"] : "imagen.jpg";

        $nombreFoto = $foto;

        //nombre que devuelve PHP de la imagen
        $tmpFoto = $_FILES["foto"]["tmp_name"];



        if ($tmpFoto != "") {
            /* Movemos el archivo a la carpeta imagenes  */
            move_uploaded_file($tmpFoto, "../Imagenes/Empleados/" . $nombreFoto);

            header('location: index.php');
        } else {
            echo "Problemas con la Foto";
        }

        $editarEmpleados->execute();
        $editarEmpleadosFoto->execute();
        $conn->close();

        header('location: index.php');

        break;

    case 'btnEliminar':
        

        $eliminarEmpleado = $conn->prepare(" DELETE FROM empleados
        WHERE id_empleado = '$id_empleado' ");

        // $consultaFoto->execute();
        $eliminarEmpleado->execute();
        $conn->close();

        header('location: index.php');

        break;

    case 'btnCancelar':
        header('location: index.php');
        break;

    
}



/* Consultamos todos los empleados  */
$consultaEmpleados = $conn->prepare("SELECT * FROM empleados");
$consultaEmpleados->execute();
$listaEmpleados = $consultaEmpleados->get_result();
$conn->close();
