$('.visualizar-modal').on('click', function(){
  // obtengo la informacion del registro de la tabla y lo paso al modal
  $('#mNombre').val($(this).parent().parent().children('#nombre').html())
  $('#mProceso').val($(this).parent().parent().children('#proceso').html())
  $('#mMedida').val($(this).parent().parent().children('#medida').html())
  $('#mFechaIn').val($(this).parent().parent().children('#fechaIn').html())
  $('#mFechaOut').val($(this).parent().parent().children('#fechaOut').html())
  $('#mDescripcion').val($(this).parent().parent().children('#descripcion').html())
  $('#mIdLenguaje').val($(this).parent().parent().children('#idLenguaje').html())

})
