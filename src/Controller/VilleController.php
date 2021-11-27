<?php

namespace App\Controller;

use App\Entity\ecole;
use App\Repository\ecoleRepository;
use App\Entity\Ville;
use App\Repository\VilleRepository;
use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class VilleController extends AbstractController
{
    #[Route('/ville/{nom}', name: 'ville')]
    public function ville(string $nom = ""): Response
    {
        $repository = $this->getDoctrine()->getRepository(Ville::class);
        $nom = $repository->findOneBy([
            'nom' => $nom,
        ]);
        return $this->render('ville/ville.html.twig', [
            "ville" => $nom
        ]);
    }
}
