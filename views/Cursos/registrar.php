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
        <div class="card-header bg-primary text-light">Registrar datos del curso</div>
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
              <option value="Básico">Básico</option>
              <option value="Intermedio">Intermedio</option>
              <option value="Avanzado">Avanzado</option>
            </select>
            <label for="nivel">Nivel</label>
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
          <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
          <button class="btn btn-sm btn-secondary" type="reset">Cancelar</button>
        </div>
      </div> <!-- ./card -->
    </form>

  </div> <!-- ./container -->

  <script>
    const formulario = document.querySelector("#formulario-registro");

    function registrarCurso(){
      fetch(`../../app/controllers/CursosController.php`, {
        method: 'POST',
        headers: {'Content-Type' : 'application/json'},
        body: JSON.stringify({
          titulo          : document.querySelector("#titulo").value,
          duracionHoras   : parseInt(document.querySelector("#duracionhoras").value),
          nivel           : document.querySelector("#nivel").value,
          precio          : parseFloat(document.querySelector("#precio").value),
          fechaInicio     : document.querySelector("#fechainicio").value,
          idcategoria     :parseInt(document.querySelector("#categoria").value)
        })
      })
        .then(response => { return response.json() })
        .then(data => { 
          if (data.filas > 0){
            formulario.reset();
            alert("Guardado correctamente"); //TEMPORAL
          }
         })
        .catch(error => { console.error(error) });
    }

    //Formulario = boton[submit] (validar FRONT)
    formulario.addEventListener("submit", function (event){
      event.preventDefault(); //cancela el evento

      if (confirm("¿Está seguro de registrar?")){
        registrarCurso();
      }
    });

  </script>

</body>
</html>