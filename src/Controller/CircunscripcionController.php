<?php

namespace App\Controller;

use App\Entity\Circunscripcion;
use App\Form\CircunscripcionType;
use App\Repository\CircunscripcionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/circunscripcion')]
class CircunscripcionController extends AbstractController
{
    #[Route('/', name: 'app_circunscripcion_index', methods: ['GET'])]
    public function index(CircunscripcionRepository $circunscripcionRepository): Response
    {
        return $this->render('circunscripcion/index.html.twig', [
            'circunscripcions' => $circunscripcionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_circunscripcion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $circunscripcion = new Circunscripcion();
        $form = $this->createForm(CircunscripcionType::class, $circunscripcion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($circunscripcion);
            $entityManager->flush();

            return $this->redirectToRoute('app_circunscripcion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('circunscripcion/new.html.twig', [
            'circunscripcion' => $circunscripcion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_circunscripcion_show', methods: ['GET'])]
    public function show(Circunscripcion $circunscripcion): Response
    {
        return $this->render('circunscripcion/show.html.twig', [
            'circunscripcion' => $circunscripcion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_circunscripcion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Circunscripcion $circunscripcion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CircunscripcionType::class, $circunscripcion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_circunscripcion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('circunscripcion/edit.html.twig', [
            'circunscripcion' => $circunscripcion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_circunscripcion_delete', methods: ['POST'])]
    public function delete(Request $request, Circunscripcion $circunscripcion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circunscripcion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($circunscripcion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_circunscripcion_index', [], Response::HTTP_SEE_OTHER);
    }
}
