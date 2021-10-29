<?php

namespace App\Controller;

use App\Repository\VilleRepository;
use App\Repository\RestaurantRepository;
use App\Repository\ProprietaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends AbstractController
{
    public function __construct(VilleRepository $villeRepos, RestaurantRepository $restauRepos, ProprietaireRepository $proprietaireRepos) {
        $this->villeRepos = $villeRepos;
        $this->restauRepos = $restauRepos;
        $this->proprietaireRepos = $proprietaireRepos;

    }
    /**
     * @Route("/", name="ville")
     */
    public function index(): Response
    {
        $villes = $this->villeRepos->findAll();
        return $this->render('ville/index.html.twig', [
            'villes' => $villes,
        ]);
    }

    /**
     * @Route("/ville/{nom}", name="single_ville")
     */
    public function single_ville($nom): Response
    {
        $ville = $this->villeRepos->findOneBy(['nom' => $nom]);
        if (!empty($ville)) {
            return $this->render('ville/single_ville.html.twig', [
                'ville' => $ville,
            ]);
        }
        else {
            $villes = $this->villeRepos->findAll();
            return $this->render('ville/index.html.twig', [
                'villes' => $villes,
            ]);
        }

    }
    /**
     * @Route("/restaurant/{nom}", name="single_restaurant")
     */
    public function single_restaurant($nom): Response
    {
        $restaurant = $this->restauRepos->findOneBy(['nom' => $nom]);
        if (!empty($restaurant)) {
            return $this->render('restaurant/single_restaurant.html.twig', [
                'restaurant' => $restaurant,
            ]);
        }
        else {
            $villes = $this->villeRepos->findAll();
            return $this->render('ville/index.html.twig', [
                'villes' => $villes,
            ]);
        }


    }

    /**
     * @Route("/proprietaire/{nom}", name="single_proprietaire")
     */
    public function single_proprietaire($nom): Response
    {
        $proprietaire = $this->proprietaireRepos->findOneBy(['nom' => $nom]);
        if (!empty($proprietaire)) {
            return $this->render('proprietaire/single_proprietaire.html.twig', [
                'proprietaire' => $proprietaire,
            ]);
        }
        else {
            $villes = $this->villeRepos->findAll();
            return $this->render('ville/index.html.twig', [
                'villes' => $villes,
            ]);
        }

    }
}
