$('.visualizar-modal').on('click', function(){
  $('#mNombre').val($(this).parent().parent().children('#nombre').html())
  $('#mProceso').val($(this).parent().parent().children('#proceso').html())
  $('#mMedida').val($(this).parent().parent().children('#medida').html())
  $('#mFechaInProyecto').val($(this).parent().parent().children('#fechaIn').html())
  $('#mFechaOutProyecto').val($(this).parent().parent().children('#fechaOut').html())
  $('#mDescripcion').val($(this).parent().parent().children('#descripcion').html())
  $('#mIdLenguaje').val($(this).parent().parent().children('#idLenguaje').html())

})
