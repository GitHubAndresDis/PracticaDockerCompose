<?php
    require "conexion.php";
    
    $datos = json_decode(file_get_contents("php://input"));
  
    $request = $datos->request;
   
    // READ: Leer los registros de la base de datos
    if($request == 1){
      $sql = "SELECT id, nombre, telefono, email, direccion FROM usuarios";
     
      $query = $mysqli->query($sql);
        
      $datos = array();
      while($resultado = $query->fetch_assoc()) {
        $datos[] = $resultado;
      }
        
      echo json_encode($datos);
      exit;
    }

    // CREATE: Insertar registro en la base de datos
    if($request == 2) {

      $nombre = $datos->nombre;
      $telefono = $datos->telefono;
      $email = $datos->email;
      $direccion = $datos->direccion;

      $sql_select = "SELECT nombre FROM usuarios WHERE nombre='$nombre'";
      $query_select = $mysqli->query($sql_select);

      if(($query_select->num_rows) == 0) {
        // Inserta los datos correspondientes
        $sql_insert = "INSERT INTO usuarios(id, nombre, telefono, email, direccion) VALUES('$nombre', '$telefono', '$email', '$direccion')";
       $sql = $mysqli->query($sql_insert);
        if($mysqli->query($sql_insert) === TRUE) {
          echo "Guardado exitoso.";
        } else {
          echo "algo salio mal.";
        }
      } else {
        echo "Esos datos ya existen.";
      }
      exit;
    }


    // UPDATE: Actualizar el registro de la base de datos
    if($request == 3) {
      $id = $datos->id;
      $nombre = $datos->nombre;
      $telefono = $datos->telefono;
      $email = $datos->email;
      $direccion = $datos->direccion;

      $sql_edit = "UPDATE usuarios SET nombre='$nombre', telefono='$telefono', email='$email', direccion = '$direccion'  WHERE id='$id'";
      $query_update = $mysqli->query($sql_edit);

      echo "Se actualizo el usuario.";
      exit;
    }

    // DELETE: Borrar registro de la base de datos
    if($request == 4) {
      
      $id = $datos->id;

      $sql_delete = "DELETE FROM usuarios WHERE id='$id'";
      $query_delete = $mysqli->query($sql_delete);

      echo "Usuario eliminado.";
      exit;
    }

?>