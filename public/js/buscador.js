document.getElementById('search').addEventListener('keyup', function(e){
  listado = document.getElementsByClassName('cedulas');
  for(i = 0; i < listado.length; i++){
    item = listado[i]
    search = e.target.value.toLowerCase()
    cedula = item.innerHTML.substr(0, search.length).toLowerCase()
    if(search == cedula){
      item.parentNode.classList.remove('hide')
    }else{
      item.parentNode.classList.add('hide')
    }
  }

})
