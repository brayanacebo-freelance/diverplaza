/* 

 * @author Brayan Acebo

 * @description Javascript/ajax necesario para funciones de programación

 */





// Escapa todos los caracteres "extraños" para envio post y validación

// codeigniter



function escapeHtml(unsafe) {

    return unsafe

    .replace(/&/g, "&amp;")

    .replace(/</g, "&lt;")

    .replace(/>/g, "&gt;")

    .replace(/"/g, "&quot;")

    .replace(/'/g, "&#039;")

    .replace(/#/g,"&#035;")
    
    .replace(/:/g,"&#058;");

}


    

// Edita campo oculto para el texto wysiwyg que se envia por post

$(document).on("submit","#form-wysiwyg", function() {  

    $('#text').val(escapeHtml($('#text-wysiwyg').val()));
    $('#map').val(escapeHtml($('#text-wysiwyg-map').val()));

});






