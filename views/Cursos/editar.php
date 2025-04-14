<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TiendaApp</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
  
  <div class="container">

    <form action="" autocomplete="off" id="formulario-registro">
      <div class="card mt-3">
        <div class="card-header bg-primary text-light">Actualizar datos del curso</div>
        <div class="card-body">
          
          <div class="form-floating mb-2">
            <select name="categoria" id="categoria" class="form-select" required>
              <option value="">Seleccione</option>
              <option value="1">Matemáticas</option>
              <option value="2">Literatura</option>
              <option value="3">Informática</option>
            </select>
            <label for="categoria">Categoria</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" class="form-control" id="titulo" placeholder="Titulo" required>
            <label for="titulo">Titulo</label>
          </div>

          <div class="form-floating mb-2">
            <input type="text" class="form-control" id="duracionhoras" placeholder="Tiempo" required>
            <label for="duracionhoras">Duracion del curso</label>
          </div>

          <!-- Compartir fila -->
          <div class="row g-2">

          <div class="form-floating mb-2">
            <select name="nivel" id="nivel" class="form-select" required>
              <option value="">Seleccione</option>
              <option value="1">Básico</option>
              <option value="2">Intermedio</option>
              <option value="3">Avanzado</option>
            </select>
            <label for="nivel">Categoria</label>
          </div>
            
            <div class="col">
              <div class="form-floating mb-2">
                <input type="text" class="form-control text-end" id="precio" placeholder="Precio" required>
                <label for="precio">Precio</label>
              </div>
            </div>

          </div>
          <!-- Fin compartir fila -->
           
          <div class="col">
              <div class="form-floating mb-2">
                <input type="date" class="form-control text-end" id="fechainicio" placeholder="Fecha de inicio del curso" required>
                <label for="fechainicio">Fecha de inicio</label>
              </div>
            </div>

        </div>
        <div class="card-footer text-end">
          <button class="btn btn-sm btn-primary" type="submit">Actualizar</button>
          <button class="btn btn-sm btn-secondary" type="reset">Cancelar</button>
        </div>
      </div> <!-- ./card -->
    </form>

  </div> <!-- ./container -->

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      
      //Debemos obtener el ID que nos envió la vista "listar"
      
      function obtenerRegistro(){
        const URL = new URLSearchParams(window.location.search);
        const idcursos = URL.get('id');

        //Los parámetros GET pueden ir en un objeto
        const parametros = new URLSearchParams();
        parametros.append("task", "getById");
        parametros.append("idcursos", idcursos)

        fetch(`../../app/controllers/CursosController.php?${parametros}` , { method: 'GET' })
          .then(response => { return response.json() })
          .then(data => { console.log(data) })
          .catch(error => { console.error(error) });
      }

      obtenerRegistro();

    });
  </script>

</body>
</html>