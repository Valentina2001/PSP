$('.visualizar-modal').on('click', function(){
  // obtengo la informacion del registro de la tabla y lo paso al modal
  $('#mId').val($(this).parent().parent().children('#id').html())
  $('#mFecha').val($(this).parent().parent().children('#fecha').html())
  $('#mProblema').val($(this).parent().parent().children('#descripcion').html())
  $('#mPropuesta').val($(this).parent().parent().children('#solucion').html())
  $('#mComentario').val($(this).parent().parent().children('#comentarios').html())

})
