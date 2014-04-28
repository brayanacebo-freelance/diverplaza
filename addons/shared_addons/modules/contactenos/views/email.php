<!------------------------------
|  @autor: Brayan Acebo
|  brayan.acebo@imaginamos.co
|  Agencia: imaginamos.com
|  Bogotá, Colombia, 2013
------------------------------->
<!doctype html>
<html>
    <body>

        <h3>Hola Brayan,</h3>

        <p>Hay alguien que desea ponerse en contacto con usted, a continuaci&oacute;n sus datos.</p>

        <strong>Nombre y Apellido: </strong> <label><?php echo @$post['name'] ?></label><br>
        <strong>E-mail: </strong> <label><?php echo @$post['email'] ?></label><br>
        <strong>Teléfono: </strong> <label><?php echo @$post['phone'] ?></label><br>
        <strong>Empresa: </strong> <label><?php echo @$post['company'] ?></label><br>
        <strong>Municipio: </strong> <label><?php echo @$post['city'] ?></label><br>

        <strong>Mensaje: </strong> 
        <div style="width: 700px;">
            <label><?php echo @$post['message'] ?></label>  
        </div>

        <br><br>
        <img src="http://www.blissfulproductivity.com/wp-content/uploads/2013/02/linea.jpg">
        <br>
        <div style="text-align: center">
            <p style="color: gray;font-size: 10px">
                La información contenida en este mensaje es confidencial y sólo puede ser utilizada por el individuo o la compañía a la cual está dirigido. Si no es el receptor autorizado, cualquier retención, reproducción, difusión, distribución o copia de este correo electrónico es prohibida y será sancionada por la ley. Excepto en casos de culpa grave o dolo, no aceptamos ninguna responsabilidad por pérdidas o daño causados por virus informáticos en correos electrónicos o en programas de computador (software). El que ilícitamente sustraiga, oculte, extravíe, destruya, intercepte, controle o impida esta comunicación, antes de que llegue a su destinatario, estará sujeto a las sanciones penales correspondientes. Igualmente, incurrirá en sanciones penales el que, en provecho propio o ajeno o con perjuicio de otro, divulgue o emplee la información contenida en esta comunicación. En particular, los servidores públicos que reciban este mensaje están obligados a asegurar y mantener la confidencialidad de la información en él contenida y, en general, a cumplir con los deberes de custodia, cuidado, manejo y demás previstos en el régimen disciplinario. Si por error recibe este mensaje, le solicitamos enviarlo de vuelta a Imaginamos a la dirección de correo electrónico que se lo envió y borrarlo de sus archivos electrónicos o destruirlo.
            </p>
            <p style="color: green;font-size: 12px;text-align: justify">Evite imprimir, piense en su compromiso con el Medio Ambiente.</p>
        </div>

    </body>
</html>