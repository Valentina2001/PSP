$('.visualizar-modal').on('click', function(e){
  $('#mid').val($(this).parent().parent().children('#id').html())
  $('#mFechaIn').val($(this).parent().parent().children('#momentoIn').html())
  $('#mFechaOut').val($(this).parent().parent().children('#momentoOut').html())
  $('#mTipoError').val($(this).parent().parent().children('#errorTipo').html())
  $('#mLDC').val($(this).parent().parent().children('#ldc').html())
  $('#mTiempo').val((($(this).parent().parent().children('#tiempo').html()) / 60).toFixed(2))
  $('#mFaseIn').val($(this).parent().parent().children('#faseIn').html())
  $('#mFaseOut').val($(this).parent().parent().children('#faseOut').html())
  $('#mDescError').val($(this).parent().parent().children('#descError').html())
  $('#mDescSoluc').val($(this).parent().parent().children('#descSoluc').html())
})


$('.visualizar-errores').on('click', function(e){
  $('#mCodigo').val($(this).parent().parent().children('#codigo').html())
  $('#mNombre').val($(this).parent().parent().children('#nombre').html())
  $('#mDescripcion').val($(this).parent().parent().children('#descripcion').html())
})
