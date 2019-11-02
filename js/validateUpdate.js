function ValidateUpdate() {

    var dni, apyn, email, sexo, hobbies, ocupacion, sugerencias;
    dni = document.getElementById("dni").value;
    apyn = document.getElementById("apyn").value;
    email = document.getElementById("email").value;
    hobbies = document.form1.elements["hobbies[]"];
    ocupacion = document.getElementById("ocp").value;
    sugerencias = document.getElementById("ocp").value;
    //pass = document.getElementById("pass").value;


    
    // var checkdni = Number.isInteger(dni);
    if (dni == "") {
        
        // alert("Debe completar el DNI");
        Swal.fire({
             type: 'error',
            title: 'Oops...',
            text: 'Debe completar el DNI',
            
          })
        return false;
                        
    }
        
        else if (dni.length < 8) {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'El DNI debe contener 8 dígitos y debe contener solo numeros',
            
          })
        return false;
    }

    if (apyn == "") {
        // alert("Debe completar su Nombre y Apellido");
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Debe completar su Nombre y Apellido',
            
          })
        return false;
    }

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


    if(document.form3.sexo[0].checked==false && document.form1.sexo[1].checked==false){
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Falta genero',
            
          })
            return false;
        }

    var checkHobbie = false;
    for (i = 0; i < hobbies.length; i++) {
        if (hobbies[i].checked) {
            // alert(hobbies[i].value);
            // Swal.fire({
                
            // 	type: 'success',
            // 	title: 'Usted ha elegido el siguente hobbie',
            // 	text: (hobbies[i].value),
            // 	showConfirmButton: false,
            // 	timer: 5000
            //   })
            checkHobbie = true;
        }
    }
    if (checkHobbie == false){
        // alert("No seleccionó ningún hobbie");
        Swal.fire({
            
            type: 'error',
            title: 'Oops...',
            text: "No seleccionó ningún hobbie",
            
          })
        return false;
    }

    if (ocupacion == "") {

        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Debe elegir su Ocupacion',
            
          })
        return false;
    }

    if (sugerencias == "") {
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Debe enviar una sugerencia',
            
          })
        return false;
        
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
