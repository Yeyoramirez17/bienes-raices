<?php 
namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index( Router $router ) 
    {
        $propiedades = Propiedad::get(3);

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => true,
        ]);
    }
    public static function nosotros( Router $router ) 
    {
        $router->render('paginas/nosotros');
    }    
    public static function propiedades( Router $router ) 
    {
        $propiedades = Propiedad::all();
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad( Router $router ) 
    {
        $id = validarORedireccionar( '/propiedades' );
        $propiedad = Propiedad::find( $id );

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router) 
    {
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router) 
    {
        $router->render('paginas/entrada');
    }
    public static function contacto(Router $router) 
    {
        $mensaje = null;

        if( $_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuesta = $_POST['contacto'];

            // debuguear($respuesta);

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '77968830433d13';
            $mail->Password = 'b0975cd4c36827';
            $mail->SMTPSecure = 'tls';
            // Configurar el contenido del E-mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices');
            $mail->Subject = 'Tienes un Nuevo Mensaje';
            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            // Definir el contenido
            $contenido  = '<html>';
            $contenido .= "<h6>Tienes un nuevo mensaje</h6>";
            $contenido .= "<p>Nombre : {$respuesta['nombre']}</p>";
            

            if( $respuesta['contacto'] === 'telefono') {
                $contenido .= "<p>Eligió ser contactado por Teléfono:</p>";
                $contenido .= "<p>Prefiere se contactado por : {$respuesta['telefono']}</p>";
                $contenido .= "<p>Fecha Contacto : {$respuesta['fecha']}</p>";
                $contenido .= "<p>Hora: $ {$respuesta['hora']}</p>";
            } else {
                $contenido .= "<p>Eligió ser contactado por email:</p>";
                $contenido .= "<p>Email : {$respuesta['email']}</p>";
            }

            $contenido .= "<p>Mensaje : {$respuesta['mensaje']}</p>";
            $contenido .= "<p>Vende o Compra : {$respuesta['tipo']}</p>";
            $contenido .= "<p>Precio o Presupuesto : $ {$respuesta['presupuesto']}</p>";
            
            
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            if($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar...";
            }

        }

        $router->render('paginas/contacto',[
            'mensaje' => $mensaje
        ]);
    }
    public static function notFound(Router $router) {
        $router->render('paginas/404');
    }
}