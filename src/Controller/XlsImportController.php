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
        dd($data);
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
