<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cursos</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
  
  <div class="container">
    <div class="card mt-3">
      <div class="card-header">Lista de las categorias actuales</div>
      <div class="card-body">
        <table class="table table-striped table-sm" id="tabla-categorias">
          <colgroup>
            <col style="width: 4%;">  <!-- ID -->
            <col style="width: 18%;"> <!-- Categoria -->

          </colgroup>
          <thead>
            <tr>
              <th>ID</th>
              <th>Categoria</th>
            </tr>
          </thead>
          <tbody>
            <!-- Contenido de forma dinámica -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>

    //Acceso global
    const tabla = document.querySelector("#tabla-categorias tbody");

    function obtenerDatos(){
      //fetch(RUTA_CONTROLADOR).then(JSON).then(DATA).catch(ERRORES)
      fetch(`../../app/controllers/CategoriasController.php?task=getAll`, {
        method: 'GET'
      })
        .then(response => { return response.json() })
        .then(data => { 
          //console.log(data);
          tabla.innerHTML = ``;

          data.forEach(element => {
            tabla.innerHTML += `
            <tr>
              <td>${element.idcategoria}</td>
              <td>${element.categoria}</td>

              <td>
                <a href='editar.php?id=${element.idcategoria}' title='Editar' class='btn btn-info btn-sm edit'><i class="fa-solid fa-pen"></i></a>
                <a href='#' title='Eliminar' data-idcategoria='${element.idcategoria}' class='btn btn-danger btn-sm delete'><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>
            `;
          });
         })
        .catch(error => { console.error(error) });
        
    }

    document.addEventListener("DOMContentLoaded", () => {
      //Renderiza los datos obtenidos desde Backend
      obtenerDatos();

      //¿Cómo enlazar un evento (click) a un control que NO existe?
      //RPTA: Delegación de evento (funciones asíncronas)
      tabla.addEventListener("click", (event) => {
        //Solo debemos detener el CLICK en el botón (Eliminar = .delete)

        //CSS => "pointer-events: none"
        const enlace = event.target.closest('a'); //Referencia a la etiquea <a> más cercana
        
        //¿Existe el enlace?, ¿el enlace tiene la class "delete"?
        if (enlace && enlace.classList.contains('delete')){
          event.preventDefault();
          const idcategoria = enlace.getAttribute('data-idcategoria');
          
          if (confirm("¿Está seguro de eliminar el registro?")){
            fetch(`../../app/controllers/CategoriasController.php/${idcategoria}`, { method: 'DELETE' })
              .then(response => { return response.json() })
              .then(datos => { 
                if (datos.filas > 0){
                  //F1: Renderizar TODA LA TABLA
                  //obtenerDatos();

                  //F2: Eliminar de la vista sola la fila necesaria
                  const filaEliminar = enlace.closest('tr');
                  if (filaEliminar) { filaEliminar.remove(); }
                }
               })
              .catch(error => { console.error(error) });
          }
        }

      });

    });

  </script>

</body>
</html>
