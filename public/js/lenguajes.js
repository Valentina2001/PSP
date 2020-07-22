$('.lenguaje').click(function(e){
  id = $(this).data('id')
  nombre = $(this).html()

  href = $('#MLenguaje').data('url')
  document.getElementById('MLenguaje').setAttribute('href' , href + "/" + id)
  $('#MIdLenguaje').val(id)
  $('#MNombre').val(nombre)
})

// document.getElementById('searchLenguaje').addEventListener('keyup', function(e){
//   console.log(e)
// })

$('#searchLenguaje').on('keyup', function(){
  listLenguaje =  document.getElementsByClassName('lenguaje')

  for(i = 0; i < listLenguaje.length; i++){
    item = listLenguaje[i]
    searchLenguaje = $('#searchLenguaje').val().toLowerCase()
    lenguaje = item.innerHTML.toLowerCase().substr(0, searchLenguaje.length)

    if(searchLenguaje == lenguaje){
      item.parentNode.classList.remove('hide')
    }else{
      item.parentNode.classList.add('hide')
    }
  }
})
