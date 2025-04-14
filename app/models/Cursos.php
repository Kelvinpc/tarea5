<?php

//Acceso al servidor y a la BD
require_once "../config/Database.php";

class Cursos{

  private $conexion;

  public function __construct() {
    $this->conexion = Database::getConexion();
  }
  
  /**
   * Devuelve un conjunto de productos contenidos en un arreglo
   * @return array
   */
  public function getAll(): array{
    $sql = "SELECT * FROM vista_cursos_todos";
    
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
    $sql = "CALL spu_cursos_registrar(?,?,?,?,?,?)"; //? = comodín (índice-ubicación)
    
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array(
        $params["titulo"],
        $params["duracionHoras"],
        $params["nivel"],
        $params["precio"],
        $params["fechaInicio"],
        $params["idcategoria"]

      )
    );

    return $stmt->rowCount();
  }

  public function edit($params = []): int{
    return 0;
  }

  public function delete($params = []): int{

    //Tipos de eliminación: FÍSICA (DELETE) - LÓGICA (UPDATE)
    $sql = "DELETE FROM cursos WHERE idcursos = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array(
        $params["idcursos"],
      )
    );

    return $stmt->rowCount();
  }

  

  public function getById($idcursos): array{
    $sql = "SELECT * FROM idcursos WHERE idcursos = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute(
      array($idcursos)
    );
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}
