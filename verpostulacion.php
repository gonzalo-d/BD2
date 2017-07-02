<?php

    $servername = "localhost";
    $username = "root";
    $password = "localhost";
    $dbname = "dbtest";

    $conn = new mysqli($servername,$username,$password,$dbname);
    if ($conn -> connect_error){
      die ("Fallo la conexión". $conn->connect_error);
    }

    ob_start();
    session_start();

    if ( isset($_SESSION['user'])!="" ) {
     header("Location: index.php");
     exit;
    }

    $res=mysqli_query($conn, "SELECT * FROM usuarios WHERE id_usuario =".$_SESSION['rol']);
    $userRow=mysqli_fetch_array($res);
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Portal Talleres USM</title>
    <link href="diseño.css" rel="stylesheet"/>
      <body>
        <div class ="menu">
          <ul id="menu">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="loged.php">Volver</a></li>
          </ul>
        </div>

        <div class="contenido">
            <table>
                <tr>
                    <td>Nombre</td>
                    <td>Semestre</td>
                    <td>Estado</td>
                    <td>Profesor<td>
                </tr>
            <?php

                $sql = "SELECT name,   FROM usuarios";
                $result = $conn->query($sql) or die("Falló la consulta" .$conn->error);
                if ($result->num_rows > 0) {
                // output data of each row
                while($rows=  mysqli_fetch_array($result)){
                    echo "<tr><td>".$rows[0]."</td>";
                    echo "<td>".$rows[1]."</td>";
                    }
                }
                else {
                  echo "0 results";
                }
                $conn->close();
            ?>
        </table>
			<form action="registroPersona.php" method="POST">
            Rol (sin guion):<br>
            <input type="text" name="Rol"><br>
            Nombre:<br>
            <input type="text" name="Nombre"><br>
            Contraseña:<br>
            <input type="text" name="Contraseña"><br>
            <input type="submit" value="Ingresar">
          </form>
        </div>
      </body>
</html>


<?php ob_end_flush(); ?>