function validaInsert(nomColumna) {
	var parametros = {
	        "nomColumna" : nomColumna
	};
	$.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'views/modules/js/alerta.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#mensaje").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#mensaje").html(response);
                }
        });
}


function insertar() {
	var parametros = {
	        "nomColumna" : $('#columna').val(),
	        "tipoDato" : $('#tipoDato').val()
	};
	$.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'views/modules/js/insertar.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                        $("#exito").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                        $("#exito").html(response);
                        $("#exito").fadeIn();
                        setTimeout(function(){
                                $("#exito").fadeOut();
                                $(location).attr("href", "index.php?p=p");
                        }, 1500);
                        
                }
        });
}