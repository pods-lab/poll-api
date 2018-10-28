<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Jhoan López <jhoanlt19@gmail.com>
 * Class DefaultController
 * @package App\Controller
 * @Rest\Route("/v1/pdf")
 */
class GeneratePDFController
{
    /**
     * Generación de PDF
     * @Rest\Post("/generar", name="generar")
     */
    public function generatePDF(Request $request)
    {
        try{
            $data = json_decode($request->getContent(), true);

            global $kernel;
            $twig = $kernel->getContainer()->get("twig");
            $content = $twig->render('generate_pdf/index.html.twig', [
                'survey' => $data
            ]);

            $mpdf = new \Mpdf\Mpdf();

            // Write some HTML code:
            $mpdf->WriteHTML($content);

            // Saves file on the server as 'filename.pdf'
            $mpdf->Output('survey.pdf', \Mpdf\Output\Destination::DOWNLOAD);

        } catch (\Exception $exception){
            //ToDo handle error
        }
    }
}