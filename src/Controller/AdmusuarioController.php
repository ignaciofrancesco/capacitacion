<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\Usuario1Type;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


#[Route('/admusuario')]
/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdmusuarioController extends AbstractController
{
    #[Route('/', name: 'app_admusuario_index', methods: ['GET'])]
    public function index(UsuarioRepository $usuarioRepository): Response
    {
        return $this->render('admusuario/index.html.twig', [
            'usuarios' => $usuarioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admusuario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UsuarioRepository $usuarioRepository, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(Usuario1Type::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $usuario->setPassword($userPasswordHasherInterface->hashPassword($usuario, $form->get("password")->getData()));
            $usuario->setFechaAlta(new \DateTime());
            $usuario->setRoles(array_values($form->get("roles")->getData()));

            $usuarioRepository->add($usuario, true);

            return $this->redirectToRoute('app_admusuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admusuario/new.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admusuario_show', methods: ['GET'])]
    public function show(Usuario $usuario): Response
    {
        return $this->render('admusuario/show.html.twig', [
            'usuario' => $usuario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admusuario_edit', methods: ['GET', 'POST'])]
  
    public function edit(Request $request, Usuario $usuario, UsuarioRepository $usuarioRepository, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $form = $this->createForm(Usuario1Type::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $usuario->setPassword($userPasswordHasherInterface->hashPassword($usuario, $form->get("password")->getData()));
            $usuario->setFechaAlta(new \DateTime());
            $usuario->setRoles(array_values($form->get("roles")->getData()));


            $usuarioRepository->add($usuario, true);

            return $this->redirectToRoute('app_admusuario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admusuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admusuario_delete', methods: ['POST'])]
    public function delete(Request $request, Usuario $usuario, UsuarioRepository $usuarioRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usuario->getId(), $request->request->get('_token'))) {
            $usuarioRepository->remove($usuario, true);
        }

        return $this->redirectToRoute('app_admusuario_index', [], Response::HTTP_SEE_OTHER);
    }
}
