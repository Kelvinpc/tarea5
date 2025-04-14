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
        <div class="card-header bg-primary text-light">Registrar categoria</div>
        <div class="card-body">
          


          <div class="form-floating mb-2">
            <input type="text" class="form-control" id="categoria" placeholder="Categoria" required>
            <label for="categoria">Categoria</label>
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
      fetch(`../../app/controllers/CategoriasController.php`, {
        method: 'POST',
        headers: {'Content-Type' : 'application/json'},
        body: JSON.stringify({
          categoria          : document.querySelector("#categoria").value,

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