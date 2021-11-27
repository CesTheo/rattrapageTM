<?php

namespace App\Controller;

use App\Entity\Ecole;
use App\Repository\EcoleRepository;
use App\Entity\Ville;
use App\Repository\VilleRepository;
use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EcoleController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Ecole::class);
        $nom = $request->request->get('nom');
        $ecole = [];
        if (is_null($nom) or empty($nom)) {
            $ecole = $repository->findBy([], ['nom' => "ASC"]);
        } else {
            $ecole = $repository->findAll($nom);
        }
        return $this->render('ecole/index.html.twig', [
            'ecoles' => $ecole,
        ]);
    }

    #[Route('/ecole/{nom}', name: 'ecole')]
    public function ville(string $nom = ""): Response
    {
        $repository = $this->getDoctrine()->getRepository(Ecole::class);
        $nom = $repository->findOneBy([
            'nom' => $nom,
        ]);
        return $this->render('ecole/ecole.html.twig', [
            "ecole" => $nom
        ]);
    }
}
