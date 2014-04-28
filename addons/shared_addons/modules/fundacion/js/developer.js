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
	.replace(/'/g, "&#039;");
}

// Edita campo oculto para el texto wysiwyg que se envia por post
$(document).on("submit","#form-wysiwyg", function() {
	$('#text').val(escapeHtml($('#text-wysiwyg').val()));
});

// Contador de caracteres para un textarea
$(function(){
	if ($('.limit-text').length) {
		var $length_max = $('.limit-text').attr("length"),
		$current_chars = $(".limit-text").val().length,
		$limit = $length_max-1;
		$(".counter-text").html($length_max + " caracteres restantes");
		$(".limit-text").keyup(function(){
			var $chars_new = $length_max - $(".limit-text").val().length;
			$(".counter-text").html($chars_new + " caracteres restantes");
			if($chars_new <= 20 && $chars_new > 0)
				$(".counter-text").css("color","#F00");
			else
				$(".counter-text").css("color","#666");
			if($chars_new <= 0){
				$(".limit-text").keypress(function(){
					var $text = $(".limit-text").val().substr(0,$limit);
					$(".limit-text").val($text);
				});
			}
		});
	}
});
