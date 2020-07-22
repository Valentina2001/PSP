$(document).ready(function(){


    // debe tener una mayusacula, una minuscula, un numero
    verify_user = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{3,16}$/
    verify_password = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/

    $('.login__content').keyup(function(){
        let email = $('#email')
        let user = $('#usuario')
        let pass1 = $('#password')
        let pass2 = $('#password2')

        let pass = null

        if(pass2.val() != ""){
          if(pass1.val() === pass2.val()){
              $('#text_password2').removeClass('text-danger')
              $('#text_password2').addClass('text-success')
              $('#text_password2').html("Contraseñas coinciden ")
              $('#password2').addClass('is-valid')
              $('#password2').removeClass('is-invalid')

              pass = true
          }else{
              $('#text_password2').addClass('text-danger')
              $('#text_password2').removeClass('text-success')
              $('#text_password2').html("Contraseñas no coinciden")
              $('#password2').addClass('is-invalid')
              $('#password2').removeClass('is-valid')

              pass = false
          }
        }else{
          $('#text_password2').html(" ")
          pass = false
        }
        if(email.val() == "" || user.val() == "" || pass == false){
            $('#cta').attr("disabled","")
        }else{
            $('#cta').removeAttr("disabled")
        }
    })


    $('#usuario').keyup(function(){
      // validación del usuario
      let user = $('#usuario')

      if(verify_user.test(user.val())){
        user.addClass('is-valid')
        user.removeClass('is-invalid')

      }else{
        user.addClass('is-invalid')
        user.removeClass('is-valid')
      }
    })

    $('#password').keyup(function(){
      // validación de la contraseña
      let pass1 = $('#password')
      if(!verify_password.test(pass1.val())){
        pass1.addClass('is-invalid')
        pass1.removeClass('is-valid')
        $('#password2').attr('disabled', "")
      }else{
        $('#password2').removeAttr('disabled')
        pass1.removeClass('is-invalid')
        pass1.addClass('is-valid')
      }
    })
})
