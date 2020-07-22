const btnSwitch = document.querySelector('#switch')
const rootStyles =  document.documentElement.style

const light = {
    '--primary-color'      : '#3BB4C1',
    '--primary-color-hover': '#A2CFD5',

    '--secondary-color'    : '#fff',

    '--terty-color'        : '#42CFD5',

    '--icon-color'         : '#048998',
    '--title-color'        : '#707070',
    '--aside-color'        : '#F6F5F5',

    '--text-color'         : '#6C757D',
    '--text-color-hover'   : 'white',
    '--text-color-dark'    : 'black',
    '--text-color-light'   : '#ccc',

    '--border-color'       : '#048998',
    '--box-shadow'         : '4px 4px 15px rgba(0,0,0, .5)'
}


const dark = {
  '--primary-color'      : '#1E242B',
  '--primary-color-hover': '#4a4a4a',

  '--secondary-color'    : '#29313C',

  '--terty-color'        : '444A51',

  '--icon-color'         : '#ccc',
  '--title-color'        : '#2DD2FF',
  '--aside-color'        : '#1E242B',

  '--text-color'         : '#9ca2a7',
  '--text-color-hover'   : 'white',
  '--text-color-dark'    : 'white',
  '--text-color-light'   : '#ccc',

  '--border-color'       : '#818181',
  '--box-shadow'         : '4px 4px 15px rgba(0,0,0, .5)'
}

setTheme()

btnSwitch.addEventListener('click', () => changeTheme())

function setTheme(){
  if(localStorage.getItem('theme') == 'claro'){
      getTheme(light)
      btnSwitch.classList.remove('active')

  }else if (localStorage.getItem('theme') == 'oscuro') {
    getTheme(dark)
    btnSwitch.classList.add('active')
  }else{
    localStorage.setItem('theme', 'claro')
  }
}

function changeTheme(){
  theme = localStorage.getItem('theme')
  if(theme == 'claro'){
    localStorage.setItem('theme', 'oscuro')
    getTheme(dark)
    btnSwitch.classList.add('active')

  }else{
    localStorage.setItem('theme', 'claro')
    getTheme(light)
    btnSwitch.classList.remove('active')
  }



}

function getTheme(theme){
  let cssVars = Object.keys(theme)
  for(let cssVar of cssVars){
      rootStyles.setProperty(cssVar, theme[cssVar])
  }
}
