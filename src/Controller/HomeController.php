<?php

namespace App\Controller;
use App\Repository\JobOfferRepository;


use App\Entity\JobOffer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(JobOfferRepository $jobOfferRepository): Response
    {        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'job_offer' =>  $jobOfferRepository->findAll(),
            // 'user' => $user
        ]);
    }

        #[Route('/contact', name: 'app_home_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [

        ]);
    }

       #[Route('/aboutUs', name: 'app_home_aboutus')]
    public function aboutUs(): Response
    {
        return $this->render('home/aboutUs.html.twig', [
            
        ]);
    }
}
