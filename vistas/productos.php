

<div class="row">
  <div class="col-md-12">
    <h4 class="bg-info"> Hola Mundo</h4>
  </div>
</div>
<form id="test">
 <input class="form-control mb-2" id="test2" required>
 <button type="button" class="btn btn-primary" id="registrar">Guardar</button>
</form>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <table id="MiPrueba">
          <thead>
            <tr>
              <th> Test</th>
            </tr>
             </thead>
              <tbody>
              </tbody>
             </table>
      </div>
    </div>
  </div>
</div>
 <script>
 $(document).ready(function(){

 $('#MiPrueba').DataTable({
  ajax:{url:"ajax/datos_materiales.ajax.php",
     type:"POST",      
     data:{accion: 3},
     dataSrc: function(respuesta){
 console.log(respuesta);
     return respuesta

     },
    // console.log(data);
    

},

 });
 document.getElementById("registrar").addEventListener("click", function(e){
  e.preventDefault();
   let accion=5;
  let registro = $("#test2").val();
 //alert(registro);
//  let datos =new FormData();
//   datos.append("accion",accion);
//   datos.append("Registro", registro);

  $.ajax({url:"ajax/datos_materiales.ajax.php",
  type:"POST",
  data:{accion,registro},
  //  cache: false,
  //  contentType: false,
  //   processData: false,
  dataType:'json',
  success: function(respuesta){


  }


  });
  

 });
 });

 </script>