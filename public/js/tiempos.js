$('.visualizar-modal').on('click', function(e){
  tiempoInput = parseFloat($(this).parent().parent().children('#tiempo').html())
  tMuerto = parseFloat($(this).parent().parent().children('#tMuerto').html())
  tTotal = tiempoInput + tMuerto

  $('#mFase').val($(this).parent().parent().children('#fase').html())
  $('#mMomentoIn').val($(this).parent().parent().children('#momentoIn').html())
  $('#mMomentoOut').val($(this).parent().parent().children('#momentoOut').html())
  $('#mInterrupciones').val($(this).parent().parent().children('#interrupciones').html())
  $('#mTiempoModal').val(tiempoInput)
  $('#MTMuerto').val(tMuerto)
  $('#mTiempoTotal').val(tTotal.toFixed(2))
  $('#mComentarios').val($(this).parent().parent().children('#comentarios').html())
})

temporizador = document.getElementById('temporizador')
iniciar = document.getElementById('iniciar')
reset = document.getElementById('resetear')
reset2 = document.getElementById('resetear2')
grabar = document.getElementById('guardar')

contentTiempoHtml = document.getElementById('contentTiempoHtml')

tiempoTotal = document.getElementById('tiempoTotal')
tiempoMuerto = document.getElementById('tiempoMuerto')

contentTiempoInput = document.getElementById('contentTiempoInput')
tiempoTotalInput = document.getElementById('tiempoTotalInput')
tiempoMuertoInput = document.getElementById('tiempoMuertoInput')

tiempo = 0
muerto = 0
interrupciones = 0
intervalo = 0
intervaloMuerto = 0
verificador = false

primerizo = true

iniciar.addEventListener('click', function(){
  iniciarContador()
})

grabar.addEventListener('click', function(){
  guardarContador()
})


reset.addEventListener('click', function(){
  resetearContador()
})
reset2.addEventListener('click', function(){
  resetearContador()
  iniciar.innerHTML = "Iniciar"
  contentTiempoInput.classList.add('d-none')
  contentTiempoHtml.classList.add('d-flex')
  contentTiempoHtml.classList.remove('d-none')
})


function iniciarContador(){
  if(primerizo  == true){
    fecha = new Date()

    if((fecha.getMonth() + 1) < 9){
      mes = '0' + (fecha.getMonth() + 1)
    }else{
      mes = (fecha.getMonth() + 1)
    }

    if(fecha.getDate() < 9){
      dia = '0' + fecha.getDate()
    }else{
      dia = fecha.getDate()
    }
    document.getElementById('fechaIn').value = fecha.getFullYear() + '-' + mes  + '-' + dia

    if(fecha.getMinutes() < 10){
      document.getElementById('horaIn').value = fecha.getHours() + ':' + '0' + fecha.getMinutes()
    }else{
      document.getElementById('horaIn').value = fecha.getHours() + ':' + fecha.getMinutes()
    }
    primerizo = false
  }

  if(verificador == false){
    intervalo = setInterval(function(){
      tiempo += 0.01;
      temporizador.innerHTML = tiempo.toFixed(2)
    }, 10)

    iniciar.innerHTML = "Pausar"
    clearInterval(intervaloMuerto)

    verificador = true
  }else{
    verificador = false
    iniciar.innerHTML = "Reanudar"
    interrupciones += 1
    intervaloMuerto = setInterval(function(){
      muerto += 0.01;
    }, 10)

    clearInterval(intervalo)
  }
}

function resetearContador(){
  verificador = false
  tiempo = 0
  muerto = 0
  tiempoTotalInput.value = tiempo
  tiempoMuertoInput.value = muerto


  document.getElementById('fechaIn').value = '0000-00-00'
  document.getElementById('horaIn').value = ''
  document.getElementById('ctaGuardar').setAttribute('disabled', '');

  primerizo = true

  temporizador.innerHTML = tiempo +'.00'
  clearInterval(intervalo)
  clearInterval(intervaloMuerto)


}


function guardarContador(){
  contentTiempoInput.classList.remove('d-none')
  tiempoTotalInput.value =  (tiempo.toFixed(2) / 60).toFixed(2) + ' minutos'
  tiempoMuertoInput.value = (muerto.toFixed(2) / 60).toFixed(2) + ' minutos'

  tiempoTotal.value =  tiempo.toFixed(2)
  tiempoMuerto.value = muerto.toFixed(2)

  contentTiempoHtml.classList.remove('d-flex')
  contentTiempoHtml.classList.add('d-none')

  fecha = new Date()

  if((fecha.getMonth() + 1) < 9){
    mes = '0' + (fecha.getMonth() + 1)
  }else{
    mes = (fecha.getMonth() + 1)
  }

  if(fecha.getDate() < 9){
    dia = '0' + fecha.getDate()
  }else{
    dia = fecha.getDate()
  }

  document.getElementById('ctaGuardar').removeAttribute('disabled');
  document.getElementById('fechaOut').value = fecha.getFullYear() + '-' + mes  + '-' + dia
  if(fecha.getMinutes() < 10){
    document.getElementById('horaOut').value = fecha.getHours() + ':' + '0' + fecha.getMinutes()
  }else{
    document.getElementById('horaOut').value = fecha.getHours() + ':' + fecha.getMinutes()
  }
  document.getElementById('interruptor').value = interrupciones
}
