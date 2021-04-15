$(document).ready(function () { //cuando ha cargado la página se ejecuta el códgio

  $("#buscador").keyup(buscar); //Cuando se levanta una tecla llamo a Buscar
  $("#submit").click(creartabla); //Cuyando clico submit llamo a creartabla
  $("#buscador").keypress(function(e) { //cuando hago Enter llamo a crear tabla
        var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
            creartabla();
        }
    });

  function buscar(){

    $.post("process.php", {palabra:$('#buscador').val()}) //le mando a process.php la palabra del buscador
    .done(function(data,textStatus, jqXHR){
      $("#datalist").html(data); //si process.php ha hecho si trabajo se escribe un datalist         
    })
    .fail(function(data,textStatus, jqXHR){
      $("#datalist").html(data); //process.php no ha podido ejecutarse
              })

  }
  function creartabla(){
    $.post("creartabla.php", {palabra:$('#buscador').val()}) //se llama a creartabla.php cuando se requiere
    .done(function(data,textStatus, jqXHR){
      $("#tabla").html(data); //pinta la tabla en el div con id tabla en caso de que se llama llamado bien a creartabla
                //console.log("Tu solicitud se ha podido establecer correctamente " + textStatus);
              })
    .fail(function(data,textStatus, jqXHR){
      $("#tabla").html(data); //no se ha podido llamar a creartabla
              })
  }
});