$(document).ready(function(){
  listLenguajes()
})

$('.lenguajes').change(function(){
    $(this).parent().toggleClass('bg-primary lenguaje-active')
    listLenguajes()
})


function listLenguajes(){
  elementos = $('.lenguaje-active').children('span')

  $('#list-conocimiento').val("")
  for (i = 0; i < elementos.length; i++){
      // log(elementos[i].innerHTML
      aux = elementos[i].innerHTML

      document.getElementById('list-conocimiento').value += aux + ","
  }
  if(document.getElementById('list-conocimiento').value == ""){
      document.getElementById('list-conocimiento').value = "Selecciona un lenguaje"
  }

  $('#list-select').html("")

  for (i = 0; i < elementos.length; i++){
      // log(elementos[i].innerHTML
      aux = elementos[i].innerHTML
      var lenguaje = document.getElementById('listInput').value

      if(lenguaje == elementos[i].parentNode.getAttribute('for')){
        document.getElementById('list-select').innerHTML += "<option selected>" + aux + "</option>"
      }else{
        document.getElementById('list-select').innerHTML += "<option>" + aux + "</option>"
      }

  }
  if(document.getElementById('list-select').innerHTML == ""){
      document.getElementById('list-select').innerHTML = "<option> Selecciona un lenguaje</option>"
  }
}


var urlImg = $('#img_user').attr("src")
$('.visualizar-modal').click(function(e){
    $('#nombre').val($(this).parent().parent().children('#Dnombre').html())
    $('#apellido').val($(this).parent().parent().children('#Dapellido').html())
    $('#email').val($(this).parent().parent().children('#Demail').html())
    $('#empresa').val($(this).parent().parent().children('#Dempresa').html())
    $('#experiencia').val($(this).parent().parent().children('#Dexperiencia').html())
    $('#proyecto').val($(this).parent().parent().children('#Dproyecto').html())
    $('#usuario').val($(this).parent().parent().children('#Duser').html())
    $('#titulo').val($(this).parent().parent().children('#Dtitulo').html())

    let cedula = $(this).parent().parent().children('#Dcedula').html()
    let idProyecto = $(this).parent().parent().children('#DidProyecto').html()

    let urlV = $('#ctaV').attr('href')
    let urlP = $('#ctaP').attr('href')

    $('#ctaV').attr('href', urlV+cedula)
    $('#ctaP').attr('href', urlP+'proyectos/formulario/'+idProyecto)

    let img = $(this).parent().parent().children('#Dfoto').html()


    $('#img_user').attr("src",urlImg + img)
})

let padre = $('#list-lenguajes')
let hijos = $('.lenguaje')
$('#search').keyup(function(e){
    let valor = $(this).val().toLocaleLowerCase()

    for (let i = 0; i < hijos.length; i++){
        let option = hijos[i]
        let palabras = option.innerHTML.toLocaleLowerCase()

        if(palabras.search(valor) == 0){
          option.parentNode.classList.remove('d-none')
        }else{
          option.parentNode.classList.add('d-none')
        }
    }
})




$('#input_avatar').change(function(e) {
    addImage(e)
})

function addImage(e){
    var file = e.target.files[0],
    imageType = /image.*/

    if (!file.type.match(imageType))
    return

    var reader = new FileReader()
    reader.onload = fileOnload
    reader.readAsDataURL(file)
}

function fileOnload(e) {
    var result=e.target.result
    $('#img_user').attr("src",result)
}
$('#input_user').change(function(e){
    let img = e.target.files[0]
    let imgType = /image.*/

    if(!img.type.match(imgType)){
        return
    }

    let reader = new FileReader()
    reader.onload = fileOnload
    reader.readAsDataURL(img)
})

function fileOnload(e) {
    var result=e.target.result
    console.log(result)
    $('#img_user').attr("src",result)
}
var swiper = new Swiper('.swiper-container', {
    pagination: {
        el: '.swiper-pagination',
        type: 'progressbar',
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});
