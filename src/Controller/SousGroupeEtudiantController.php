<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Entity\SousGroupeEtudiant;
use App\Form\SousGroupeEtudiantType;
use App\Repository\SousGroupeEtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sous_groupe_etudiant")
 */
class SousGroupeEtudiantController extends AbstractController
{
    /**
     * @Route("/", name="sous_groupe_etudiant_index", methods={"GET"})
     */
    public function index(SousGroupeEtudiantRepository $sousGroupeEtudiantRepository): Response
    {
        return $this->render('sous_groupe_etudiant/index.html.twig', [
            'sous_groupe_etudiants' => $sousGroupeEtudiantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="sous_groupe_etudiant_new", methods={"GET","POST"}, defaults={"id":null}, requirements={"id":"\d+"})
     */
    public function new(Request $request, Etudiant $etudiant = null): Response
    {
        $sousGroupeEtudiant = new SousGroupeEtudiant();
        $form = $this->createForm(SousGroupeEtudiantType::class, $sousGroupeEtudiant, ['etudiant' => $etudiant]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousGroupeEtudiant);
            $entityManager->flush();

            return $this->redirectToRoute('sous_groupe_etudiant_index');
        }

        return $this->render('sous_groupe_etudiant/new.html.twig', [
            'sous_groupe_etudiant' => $sousGroupeEtudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_groupe_etudiant_show", methods={"GET"})
     */
    public function show(SousGroupeEtudiant $sousGroupeEtudiant): Response
    {
        return $this->render('sous_groupe_etudiant/show.html.twig', [
            'sous_groupe_etudiant' => $sousGroupeEtudiant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sous_groupe_etudiant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousGroupeEtudiant $sousGroupeEtudiant): Response
    {
        $form = $this->createForm(SousGroupeEtudiantType::class, $sousGroupeEtudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sous_groupe_etudiant_index');
        }

        return $this->render('sous_groupe_etudiant/edit.html.twig', [
            'sous_groupe_etudiant' => $sousGroupeEtudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_groupe_etudiant_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SousGroupeEtudiant $sousGroupeEtudiant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousGroupeEtudiant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousGroupeEtudiant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_groupe_etudiant_index');
    }
}
