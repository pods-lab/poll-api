<?php

namespace App\Controller;

use App\Classes\SendEmail;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Jhoan López <jhoanlt19@gmail.com>
 * Class SendEmailController
 * @package App\Controller
 * @Rest\Route("/v1/email")
 */
class SendEmailController extends Controller
{
    /**
     * Envío de correo
     * @Rest\Post("/enviar", name="enviar")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return array
     */
    public function send(Request $request, \Swift_Mailer $mailer)
    {
        try{
            $data = json_decode($request->getContent(), true);
            $em = $this->getDoctrine()->getManager();
            $sendEmail = new SendEmail($em);
            global $kernel;
            $twig = $kernel->getContainer()->get("twig");
            $content = $twig->render('send_email/index.html.twig', [
                'survey' => $data
            ]);

            //Se realiza el envío de correo.
            $send = $sendEmail->send(
                $mailer,
                $from = getenv("MAILER_FROM"),
                $to = $data['user_data']['email'],
                $affair = "Encuesta electrónica",
                $body = $content,
                $contenType = 'text/html');

            if($send === 1){
                $message = "Se le ha enviado un correo con el resultado!";
                $status  = true;
            } else{
                $message = "Error l enviar el correo";
                $status  = false;
            }

        }catch (\Exception $exception){
            $status  = false;
            $message = $exception->getMessage();
        }

        return [
          "status"  => $status,
          "message" => $message
        ];
    }
}
