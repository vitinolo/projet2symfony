<?php

namespace App\Controller;
use App\Entity\Rubrik;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RubrikController extends AbstractController
{
    #[Route('/rubrik', name: 'app_rubrik')]
    public function index(): Response
    {
        return $this->render('rubrik/index.html.twig', [
            'controller_name' => 'RubrikController',
        ]);
    }
}
