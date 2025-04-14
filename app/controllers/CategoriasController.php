<?php

//isset = is-set (¿está asignado?/¿existe?)
if (isset($_SERVER['REQUEST_METHOD'])){

  //El modelo contiene TODA la lógica (CRUD)
  require_once "../models/Categorias.php";
  $categorias = new Categorias();

  //¿Qué operación desea realizar el usuario?
  //GET   : consultas, búsquedas
  //POST  : inserción
  //PUT   : actualización
  //DELETE: eliminación

  switch($_SERVER['REQUEST_METHOD']){
    
    case 'GET':
      //sleep(5);
      header('Content-Type: application/json; charset=utf-8');

      //Debemos identificar si el USER requiere LISTAR / BUSCAR
      if ($_GET['task'] == 'getAll'){
        echo json_encode($categorias->getAll());
      }else if ($_GET['task'] == 'getById'){
        echo json_encode($categorias->getById($_GET['idcategorias']));
      }
      break;

    case 'POST':
      //Obtener los datos enviados desde el cliente ¿JSON, TEXT, XML?
      $input = file_get_contents('php://input');
      $dataJSON = json_decode($input, true);

      //Creamos un array asociativo con los datos del nuevo registro
      $registro = [

        'categoria'     => $dataJSON['categoria']

      ];

      //Obtenemos el número de registros
      $filasAfectadas = $categorias->add($registro);

      //Notificamos al usuario el número de filas en formato JSON
      //{"filas": 1}
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode(["filas" => $filasAfectadas]);
      break;

      case 'DELETE':
        header('Content-Type: application/json; charset=utf-8');

        //El usuario enviará el ID en la URL => localhost/tienda-app/app/controllers/7
        //Paso 1: Obtener la URL desde el cliente
        $url = $_SERVER['REQUEST_URI'];
        //Paso 2: Convertir la URL en un array
        $arrayURL = explode('/', $url);
        //Paso 3: Obtener el ID
        $idcategoria = end($arrayURL);

        $filasAfectadas = $categorias->delete(['idcategoria' => $idcategoria]);
        echo json_encode(["filas" => $filasAfectadas]);
        break;
  }

}