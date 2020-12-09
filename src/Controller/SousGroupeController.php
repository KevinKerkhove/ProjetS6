<?php

namespace App\Controller;

use App\Entity\SousGroupe;
use App\Form\SousGroupeType;
use App\Repository\PromotionRepository;
use App\Repository\SousGroupeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sous_groupe")
 */
class SousGroupeController extends AbstractController
{
    /**
     * @Route("/", name="sous_groupe_index", methods={"GET"})
     */
    public function index(SousGroupeRepository $sousGroupeRepository): Response
    {
        return $this->render('sous_groupe/index.html.twig', [
            'sous_groupes' => $sousGroupeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sous_groupe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sousGroupe = new SousGroupe();
        $form = $this->createForm(SousGroupeType::class, $sousGroupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousGroupe);
            $entityManager->flush();

            return $this->redirectToRoute('sous_groupe_index');
        }

        return $this->render('sous_groupe/new.html.twig', [
            'sous_groupe' => $sousGroupe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_groupe_show", methods={"GET"})
     */
    public function show(SousGroupe $sousGroupe, PromotionRepository $promotionRepository): Response
    {
        $promotion = $sousGroupe->getGroupe()->getPromotion();
        return $this->render('sous_groupe/show.html.twig', [
            'sous_groupe' => $sousGroupe,
            'promotion' => $promotion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sous_groupe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousGroupe $sousGroupe): Response
    {
        $form = $this->createForm(SousGroupeType::class, $sousGroupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sous_groupe_index');
        }

        return $this->render('sous_groupe/edit.html.twig', [
            'sous_groupe' => $sousGroupe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_groupe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SousGroupe $sousGroupe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousGroupe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousGroupe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_groupe_index');
    }
}
