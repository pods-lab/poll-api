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
     * @Rest\Post("/generate", name="generate_pdf")
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
            $fileName = time() . ".pdf";
            // Saves file on the server as 'filename.pdf'
            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename='$fileName'");
            header("Access-Control-Allow-Origin: *");
            $mpdf->Output('survey.pdf', \Mpdf\Output\Destination::DOWNLOAD);
            $status  = true;
            $message = "PDF generado correctamente";
        } catch (\Exception $exception){
            $status  = false;
            $message = $exception->getMessage();
        }

        return [
          "status"  => $status,
          "message" => $message,
        ];
    }
}