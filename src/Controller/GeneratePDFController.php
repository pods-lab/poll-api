<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Jhoan López <jhoanlt19@gmail.com>
 * Class DefaultController
 * @package App\Controller
 * @Rest\Route("/v1/pdf")
 */
class GeneratePDFController extends FOSRestController
{
    /**
     * Generación de PDF
     * @Rest\Post("/generate", name="generate_pdf_file")
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
            $baseDir = realpath($this->get("kernel")->getRootDir() . '/../public/temp');
            $fileName = time() . ".pdf";
            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename='$fileName'");
            header("Access-Control-Allow-Origin: *");
            $pdf = $mpdf->Output("{$baseDir}/{$fileName}", \Mpdf\Output\Destination::DOWNLOAD);
            return $pdf;
        } catch (\Exception $exception){
            //ToDo handle error
            return [
                'error' => true,
                'message' => $exception->getMessage(),
            ];
        }

        /**
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename='survey.pdf'");
        header("Access-Control-Allow-Origin: *");
         */
        return [
            'status' => true,
            'data' => $pdf
        ];
    }
}