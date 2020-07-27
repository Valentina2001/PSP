$('.visualizar-modal').on('click', function(){
  // obtengo la informacion del registro de la tabla y lo paso al modal
  $('#mId').val($(this).parent().parent().children('#id').html())
  $('#mFecha').val($(this).parent().parent().children('#fecha').html())
  $('#mNombre').val($(this).parent().parent().children('#nombre').html())
  $('#mObjetivo').val($(this).parent().parent().children('#objetivo').html())
  $('#mCondiciones').val($(this).parent().parent().children('#condiciones').html())
  $('#mEsperada').val($(this).parent().parent().children('#resEsperado').html())
  $('#mActual').val($(this).parent().parent().children('#resActual').html())
  $('#mDescripcion').val($(this).parent().parent().children('#descripcion').html())

})
