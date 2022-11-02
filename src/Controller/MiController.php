<?php

namespace App\Controller; //app es el proyecto, en este caso "capacitacion"
                        // todas las referencias de nombres, se harán dentro de esta carpeta Controller

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MiController extends AbstractController
{
    #[Route('/', name: 'internoMi')] // ruta que tipea el usuario, y q dispara la funcion; name es el nombre de referencia interno
    public function index(): Response
    {
        return $this->render('mi/index.html.twig', [  //entre corchetes se pueden pasar variables en forma de array
            'nombrePerfil' => 'nacho', //nombre de variable-->valor
            'edadController' => 34,
        ]);
    }

    #[Route('/perfil/{persona}', name: 'internoPerfil')] // otra ruta, q tipea el usuario, o q acciona algun link para llegar a ella
    public function verPerfil($persona): Response
    {
        return $this->render('mi/perfil.html.twig', [
            'nombrePerfil2' => $persona,
        ]);
    }

    #[Route('/perfil/fotos/{nombrePersona}', name: 'internoFotos')] // otra ruta, q tipea el usuario, o q acciona algun link para llegar a ella
    public function verFotos($nombrePersona): Response
    {
        return $this->render('mi/fotos.html.twig', [
            'nombrePerfil3' => $nombrePersona,
        ]);
    }
}


