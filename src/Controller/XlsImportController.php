<?php

namespace App\Controller;

use App\Entity\Fichier;
use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use App\Form\FichierType;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class XlsImportController extends AbstractController
{
    /**
     * @Route("/xls_import", name="xls_import")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $swap = 0; //variable au pif pour le flash plus tard

        $fichier = new Fichier();
        $form = $this->createForm(FichierType::class, $fichier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            /** @var UploadedFile $fichierEtudiant */
            $fichierEtudiant = $form->get('fichier')->getData();

            if ($fichierEtudiant) 
            {
                $originalFilename = pathinfo($fichierEtudiant->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'.'.$fichierEtudiant->guessExtension();
                $fichier->setFilename($newFilename);

                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                $spreadsheet = $reader->load($fichierEtudiant);
                $data = $this->createDataFromSpreadSheet($spreadsheet);
                
                foreach ($data['A convoquer 6 juillet']['columnValues'] as $convoquer)
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

                    if ($etudiant->getChoix() === "OUI")
                        $etudiant->setInscrit(true);
                    else $etudiant->setInscrit(false);

                    $emailRechercher = $this->getDoctrine()->getRepository(Etudiant::class)
                        ->findOneBy(['email' => $etudiant->getEmail()]);
                    
                    if ($emailRechercher === null)
                    {
                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($etudiant);
                        $entityManager->flush();
                    }else if ($emailRechercher !==null)
                    {
                        $swap = 666;
                    }
                }

                if ($swap === 666) 
                {
                    $this->addFlash(
                        'warning',
                        'Certaines données n\'ont pas été importé car déjà présentes'
                    );    
                }               
            }

            $this->addFlash(
                'success',
                'Fin d\'importation des donnnées'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('xls_import/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function createDataFromSpreadSheet($spreadsheet)
    {
        $data = [];
        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) 
        {
            $worksheetTitle = $worksheet->getTitle();
            $data[$worksheetTitle] = [
                'columnNames' => [],
                'columnValues' => [],
            ];
            
            foreach ($worksheet->getRowIterator() as $row) 
            {
                $rowIndex = $row->getRowIndex();
                if ($rowIndex > 2)
                {
                    $data[$worksheetTitle]['columnValues'][$rowIndex] = [];
                }
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                foreach ($cellIterator as $cell) 
                {
                    if ($rowIndex === 1) 
                        $data[$worksheetTitle]['columnNames'][] = $cell->getCalculatedValue();
                    if ($rowIndex > 1) 
                        $data[$worksheetTitle]['columnValues'][$rowIndex][] = $cell->getCalculatedValue();
                }
            }
        }        
        return $data;
    }
}
