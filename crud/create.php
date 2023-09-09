<?php

// Datos de la DB
$host = "127.0.0.1:33065";
$user = "root";
$pass = "root";
$db = "usuarios";

//Crear conexion
$con = new mysqli($host,$user,$pass,$db);

$nombre = "";
$correo = "";
$password = "";
$rol = "";

// Mensajes
$errorMessage = "";
$successMessage = "";

// Envio de datos
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $rol = $_POST["rol"];

    do{
        // En caso de dejar casillas vacias mandar un mensaje
        if(empty($nombre) || empty($correo) || empty($password) || empty($rol)){
            $errorMessage = "Hacen falta campos";
            break;
        }

        // Agregar un nuevo Usuario
        $sql = "INSERT INTO usuario (nombre, correo, password, rol)" . 
        "VALUES ('$nombre', '$correo', '$password', '$rol')";
        $result = $con->query($sql);

        if(!$result){
            $errorMessage = "Consulta invalida: " . $con->error;
            break;
        }

        $nombre = "";
        $correo = "";
        $password = "";
        $rol = "";

        $successMessage = "Registro exitoso";


    } while(false);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Nuevo Usuario</h2>

        <?php
        if(!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Correo</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="correo" value="<?php echo $correo; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contraseña</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Rol (1=admin 2=user)</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="rol" value="<?php echo $rol; ?>">
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }

            
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/crud/index.html" role="button">Cancelar</a>
                </div>
            </div>

        </form>

    </div>
</body>
</html>