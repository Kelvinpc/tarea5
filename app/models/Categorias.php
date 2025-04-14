<?php

//Acceso al servidor y a la BD
require_once "../config/Database.php";

class Categorias{

  private $conexion;

  public function __construct() {
    $this->conexion = Database::getConexion();
  }
  
  /**
   * Devuelve un conjunto de productos contenidos en un arreglo
   * @return array
   */
  public function getAll(): array{
    $sql = "SELECT * FROM vista_categoria_todos";
    
    $stmt = $this->conexion->prepare($sql); //1. Preparación (seguridad)
    $stmt->execute(); //2. Ejecución

    return $stmt->fetchAll(PDO::FETCH_ASSOC); //3. Retorno FETCH_ASSOC (arreglo asociativo)
  }

  /**
   * Registra un nuevo curso en la BD
   * @param mixed $params
   * @return int
   */
  public function add($params = []): int{
    $sql = "CALL spu_categoria_registrar(?)"; //? = comodín (índice-ubicación)
    
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array(
        $params["categoria"]

      )
    );

    return $stmt->rowCount();
  }

  public function edit($params = []): int{
    return 0;
  }

  public function delete($params = []): int{

    //Tipos de eliminación: FÍSICA (DELETE) - LÓGICA (UPDATE)
    $sql = "DELETE FROM categoria WHERE idcategoria = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array(
        $params["idcategoria"],
      )
    );

    return $stmt->rowCount();
  }

  

  public function getById($idcategoria): array{
    $sql = "SELECT * FROM idcategoria WHERE idcategoria = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array($idcategoria)
    );
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}
