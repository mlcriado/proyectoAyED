function ValidateLogin() {

    var email, pass;
    email = document.getElementById("email").value;
    pass = document.getElementById("pass").value;


    if (email == ""|| email.length < 10) {
				
     
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Error al escribir el email',
            
          })
        return false;

      
                        
    } else {

      var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
			if (!regex.test(email)) {
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'La direccion de correo no es correcta',
					
				  })
				return false;
				
			} 
    }

    if (pass == "") {
				
    
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'El campo Password no puede ser vacio',
            
          })
        return false;
                        
    }

}