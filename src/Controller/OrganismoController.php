<?php

namespace App\Controller;

use App\Entity\Organismo;
use App\Form\OrganismoType;
use App\Repository\OrganismoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;


#[Route('/organismo')]
class OrganismoController extends AbstractController
{
    #[Route('/', name: 'app_organismo_index', methods: ['GET'])]
    public function index(OrganismoRepository $organismoRepository): Response
    {
        return $this->render('organismo/index.html.twig', [
            'organismos' => $organismoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_organismo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $organismo = new Organismo();
        $form = $this->createForm(OrganismoType::class, $organismo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($organismo);
            $entityManager->flush();

            return $this->redirectToRoute('app_organismo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('organismo/new.html.twig', [
            'organismo' => $organismo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_organismo_show', methods: ['GET'])]
    public function show(Organismo $organismo): Response
    {
        return $this->render('organismo/show.html.twig', [
            'organismo' => $organismo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_organismo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Organismo $organismo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrganismoType::class, $organismo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_organismo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('organismo/edit.html.twig', [
            'organismo' => $organismo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_organismo_delete', methods: ['POST'])]
    public function delete(Request $request, Organismo $organismo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$organismo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($organismo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_organismo_index', [], Response::HTTP_SEE_OTHER);
    }
}
