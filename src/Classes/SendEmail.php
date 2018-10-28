<?php

namespace App\Classes;


use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Esta clase expone los métodos relacionados con el envío de correo.
 * @package App\Controller\Web
 * @author Jhoan López <jhoanlt19@gmail.com>
 * @since 1.0.0
 * @Rest\Route("/web-registro")
 */
class SendEmail
{

    private $em = null;

    /**
     * SendEmail constructor.
     * @param ObjectManager $em
     */
    public function __construct(ObjectManager $em) {
        $this->em = $em;
    }

    /**
     * Función encargada de realizar el envío de correos
     * @param \Swift_Mailer $mailer - Librería
     * @param $from - e-mail del cual va a partir en envío
     * @param $to - e-mail hacía donde va a ser enviado el correo
     * @param $affair - Asunto del e-mail
     * @param $body - Cuerpo del e-mail
     * @param $contentType - Tipo de contenido (html, plain, etc)
     * @return int
     */
    public function send(\Swift_Mailer $mailer, $from, $to, $affair, $body, $contentType) {
        try {

            $message = (new \Swift_Message($affair))
                ->setFrom($from)
                ->setTo($to)
                ->setBody(
                    $body,
                    $contentType
                );

            return $mailer->send($message);
        }
        catch (\Exception $e){
            //ToDo
        }
    }
}