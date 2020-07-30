
$('#searchReporte').on('keyup', function(){
  nombres = document.getElementsByClassName('nombres')
  buscador = $(this).val().toLowerCase()
  for(i = 0; i < nombres.length; i++){
    item = nombres[i]
    console.log()

    nombre = item.innerHTML.substr(0, buscador.length).toLowerCase()
    if(buscador == nombre){
        item.parentNode.parentNode.classList.remove('hide')
    }else{
        item.parentNode.parentNode.classList.add('hide')
    }
  }
})

$('.buscar-reporte').on('click', function(){
  swal("Por favor ingresar la cedula del programador que desea consultar", {
    content: "input",
  })
  .then((value) => {
    if(value != null){
      window.location.href = $('#url').html() + "ReportesGenerales/reporte/" + value
    }
  });
})
