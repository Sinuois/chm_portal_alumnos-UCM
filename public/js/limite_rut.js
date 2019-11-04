$(document).ready(function(){
    $("#rut").on("keypress", function limite_rut(evt){ //funcion para restringir el rut a números.
        evt = (evt) ? evt : window.event; //definir un evento de js
        var charCode = (evt.which) ? evt.which : evt.keyCode; // definir que charCode es el código ascii de lo que se ingresa (input)   
        if (charCode<48 || charCode>57) { //en la tabla ascii los números del 0-9 son los numeros del 48 al 57
            return false; //este if se encarga de no permitir que se escriba cualquier caracter que  no sea numero.
        }
        return true;
    });


});