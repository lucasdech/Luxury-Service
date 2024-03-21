<?php

namespace App\Controller\Admin;

use App\Controller\ClientController;
use App\Entity\Candidats;
use App\Entity\Client;
use App\Entity\JobOffer;
use App\Entity\JobToCandidat;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

         dump($this->getUser()->getRoles());

    foreach ($this->getUser()->getRoles() as $key) {
        
        if ($key == 'ROLE_ADMIN') {
            

    


        // if ($this->getUser()->getRoles()  == 'ROLE_ADMIN') {
            # code...
        

        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CandidatsCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('http://luxuryservices.dvl.to/admin/admin.html.twig');

        // }

            }else {
                
                return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER); 
            }

        }
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LuxuryServices');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Client', 'fa-solid fa-store', Client::class);
        yield MenuItem::linkToCrud('candidats', 'fa-regular fa-user', Candidats::class);
        yield MenuItem::linkToCrud('Job Offer', 'fa-solid fa-briefcase', JobOffer::class);
        yield MenuItem::linkToCrud('Job To Candidat', 'fa-regular fa-handshake', JobToCandidat::class);
        yield MenuItem::linkToCrud('User', 'fa-regular fa-user', User::class);
    }
}
