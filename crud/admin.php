<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Bienvenido Administrador</h2>
        <a class="btn btn-primary" href="/crud/index.html" role="<button mat-button>text</button>">Salir</a>
        
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>idUsuario</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = "127.0.0.1:33065";
                $user = "root";
                $pass = "root";
                $db = "usuarios";

                //Crear conexion
                $con = new mysqli($host,$user,$pass,$db);

                //Verificar la conexion
                if ($con->connect_error){
                    die("Conexion fallida: " . $con->connect_error);
                }

                // Leer las filas de la tabla de la bd
                $sql = "SELECT * FROM usuario";
                $result = $con->query($sql);

                if(!$result){
                    die("Consulta invalida: " . $con->error);
                }

                // Lee los datos de cada fila
                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                        <td>$row[idUsuario]</td>
                        <td>$row[nombre]</td>
                        <td>$row[correo]</td>
                        <td>$row[password]</td>
                        <td>$row[rol]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/crud/edit.php?idUsuario=$row[idUsuario]'>Editar</a>
                            <a class='btn btn-danger btn-sm' href='/crud/delete.php?idUsuario=$row[idUsuario]'>Eliminar</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
                
            </tbody>

        </table>
    </div>
    
</body>
</html>