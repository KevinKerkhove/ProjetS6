<?php

namespace App\Controller;

use App\Entity\Etudiant;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class XlsImportController extends AbstractController
{
    /**
     * @Route("/xls/import", name="xls_import")
     */
    public function index(): Response
    {
        /* Ecrire un fichier xls
            $spreadsheet = new SpreadSheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'YO!');

            $writer = new Xls($spreadsheet);
            $writer->save('Yo.xls');
        */

        $inputFileName = 'DUT-Informatique-2019-06-12.xls';

        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load($inputFileName);
        $data = $this->createDataFromSpreadSheet($spreadsheet);
        foreach($data['A convoquer 6 juillet']['columnValues'] as $convoquer)
        {  
            
            $etudiant = new Etudiant();
            $etudiant->setChoix($convoquer[0]);
            $etudiant->setNom($convoquer[1]);
            $etudiant->setPrenom($convoquer[2]);
            $etudiant->setCivilite($convoquer[3]);
            $etudiant->setAdresse1($convoquer[4]);
            $etudiant->setAdresse2($convoquer[5]);
            $etudiant->setAdresse3($convoquer[6]);
            $etudiant->setCodePostal($convoquer[7]);
            $etudiant->setCommune($convoquer[8]);
            $etudiant->setPays($convoquer[9]);
            $etudiant->setTelephone($convoquer[10]);
            $etudiant->setTelephoneMobile($convoquer[11]);
            $etudiant->setEmail($convoquer[12]);
            $etudiant->setEmailResponsable1($convoquer[13]);
            $etudiant->setEmailResponsable2($convoquer[14]);
           
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etudiant);
            $entityManager->flush();
        }
        
        return $this->render('xls_import/index.html.twig', [
            'controller_name' => 'XlsImportController',
            'data' => $data,
        ]);
    }

    public function createDataFromSpreadSheet($spreadsheet)
    {
        $data = [];
        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
            $worksheetTitle = $worksheet->getTitle();
            $data[$worksheetTitle] = [
                'columnNames' => [],
                'columnValues' => [],
            ];
            
            foreach ($worksheet->getRowIterator() as $row) {
                $rowIndex = $row->getRowIndex();
                if ($rowIndex > 2) {
                    $data[$worksheetTitle]['columnValues'][$rowIndex] = [];
                }
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false); // Loop over all cells, even if it is not set
                foreach ($cellIterator as $cell) {
                    if ($rowIndex === 1) {
                        $data[$worksheetTitle]['columnNames'][] = $cell->getCalculatedValue();
                    }
                    if ($rowIndex > 1) {
                        $data[$worksheetTitle]['columnValues'][$rowIndex][] = $cell->getCalculatedValue();
                    }
                }
            }
           
        }        
        return $data;
    }
}
