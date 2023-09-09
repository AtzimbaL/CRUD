<?php
$host = "127.0.0.1:33065";
$user = "root";
$pass = "root";
$db = "usuarios";

$con = new mysqli($host,$user,$pass,$db);

$correo = "";
$password = "";
$rol = "";


$errorMessage = "";
$successMessage = "";

if(!$con){
    die("Error de conexión: " . mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Datos del formulario
    $correo = $_POST["correo"];
    $password = $_POST["password"];

    do{
        if(empty($correo) || empty($password)){
            $errorMessage = "Hacen falta campos";
            break;
        }

        // Agregar un nuevo Usuario
        $sql = "SELECT rol FROM usuario WHERE correo = '$correo' AND password = '$password'";
        $result = $con->query($sql);

        // Determinar si es admin o user
        if($result && mysqli_num_rows($result) == 1){
            $fila = mysqli_fetch_assoc($result);
            $rol = $fila['rol'];

            $_SESSION["rol"] = $rol;

            if ($rol == 1) {
                header("Location: admin.php");
            } else {
                header("Location: http://localhost:5173/");
            }

        } 
        


        /*/ Verificar si encontro el usuario
        if (mysqli_num_rows($result) == 1) {
        
        // Usuario autenticado, puedes redirigirlo a una página de inicio de sesión exitosa o realizar otras acciones.
        echo "Inicio de sesión exitoso. Bienvenido, $correo!";
        } else {
            // Usuario no encontrado o contraseña incorrecta, puedes mostrar un mensaje de error.
            echo "Correo o contraseña incorrectos. Por favor, inténtalo de nuevo.";
        }*/
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
        <h2>Iniciar Sesión</h2>

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
                    <button type="submit" class="btn btn-primary" href="/crud/index.php">Ingresar</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/crud/index.html" role="button">Regresar</a>
                </div>

            </div>
        </form>

    </div>
</body>
</html>