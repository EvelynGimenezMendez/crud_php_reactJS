<?php 
    include 'bd/BD.php';

    header ("Access-Control-Allow-Origin: *");

    if ($_SERVER['REQUEST_METHOD']=='GET') {
        if(isset($_GET['id'])) {
            $query= "SELECT * from frameworks WHERE id =".$_GET['id'];
            $resultado = metodoGet($query);
            echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
        } else {
            $query = "SELECT * FROM frameworks";
            $resultado=metodoGet($query);
            echo json_encode ($resultado->fetchAll());

        }
        header("HTTP/1.1 200 OK");
        exit();
    }

    if  ($_POST['METHOD']=='POST') {
        unset ($_POST['METHOD']);
        $nombre = $_POST['nombre'];
        $lanzamiento = $_POST ['lanzamiento'];
        $desarrollador = $_POST ['desarrollador'];
        $query="INSERT INTO frameworks (nombre, lanzamiento, desarrollador) VALUES ('$nombre', '$lanzamiento', '$desarrollador')";
        $queryAutoIncrement="SELECT MAX(id) AS id FROM frameworks";
        $resultado=metodoPost($query, $queryAutoIncrement);
         echo json_encode($resultado);
         header("HTTP/1.1 200 OK");
         exit ();
    }

    if  ($_POST['METHOD']=='PUT') {
        unset ($_POST['METHOD']);
        $id=$_GET['id'];
        $nombre = $_POST['nombre'];
        $lanzamiento = $_POST ['lanzamiento'];
        $desarrollador = $_POST ['desarrollador'];
        $query="UPDATE frameworks SET nombre='$nombre', lanzamiento='$lanzamiento', desarrollador='$desarrollador' WHERE id='$id'";
        $queryAutoIncrement="SELECT MAX(id) AS id FROM frameworks";
        $resultado=metodoPut($query);
         echo json_encode($resultado);
         header("HTTP/1.1 200 OK");
         exit ();
    }

    if  ($_POST['METHOD']=='DELETE') {
        unset ($_POST['METHOD']);
        $id=$_GET['id'];
        $nombre = $_POST['nombre'];
        $query="DELETE FROM frameworks WHERE id='$id'";
        $resultado=metodoDelete($query);
         echo json_encode($resultado);
         header("HTTP/1.1 200 OK");
         exit ();
    }

    header("HTTP/1.1 400 Bad Request");
