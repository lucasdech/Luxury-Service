<?php

namespace App\Controller;

use App\Entity\Candidats;
use App\Form\CandidatsType;
use App\Repository\CandidatsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DateTimeImmutable;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;




#[Route('/candidats')]
class CandidatsController extends AbstractController
{
    #[Route('/', name: 'app_candidats_index', methods: ['GET'])]
    public function index(CandidatsRepository $candidatsRepository): Response
    {
        return $this->render('candidats/index.html.twig', [
            'candidats' => $candidatsRepository->findAll(),
        ]);
    }

    // #[Route('/new', name: 'app_candidats_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $candidat = new Candidats();
    //     $user = $this->getUser();
    //     $candidat->setUserId($user);
    //     $email = $user->getEmail();
    //     $candidat->setEmail($email);

    //     $form = $this->createForm(CandidatsType::class, $candidat);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         // $entityManager->persist($candidat);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_candidats_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('candidats/new.html.twig', [
    //         'candidat' => $candidat,
    //         'form' => $form,
    //     ]);
    // }



    #[Route('/edit', name: 'app_candidats_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        // mise en place des dates pour le created art et update at 
        date_default_timezone_set('UTC');
        $date = new DateTimeImmutable();
        $date->format('Y-m-d');
        // fin des dates 

        if ($user->getCandidats()) {

            $candidat = $user->getCandidats();
            $email = $user->getEmail();
            $candidat->setEmail($email);
            $candidat->setDateCreated($date);

        }else {
        
            $candidats = new Candidats;            
            $user->setCandidats($candidats);
            $email = $user->getEmail();
            $candidats->setEmail($email);
            $candidats->setDateUpdated($date);
        }

        $candidat = $user->getCandidats();
        $email = $user->getEmail();
        $candidat->setEmail($email);

        $form = $this->createForm(CandidatsType::class, $candidat);
        $form->handleRequest($request);     
    

        if ($form->isSubmitted() && $form->isValid()) {

            // POUR LE CV 
            $CV = $form->get('cv')->getData();

                 if ($CV) {
                $originalFilename = pathinfo($CV->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$CV->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $CV->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
            
                $candidat->setCv($newFilename);
            }

            // POUR LE PASSEPORT 
            $Passeport = $form->get('passPort_files')->getData();

                    if ($Passeport) {
                    $originalFilename = pathinfo($Passeport->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$Passeport->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $Passeport->move(
                            $this->getParameter('Passeport_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                
                $candidat->setPassPortFiles($newFilename);
            }

            //POUR LA PHOTO DE PROFIL
            $ProfilPic = $form->get('profil_picture')->getData();

                    if ($ProfilPic) {
                    $originalFilename = pathinfo($ProfilPic->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$ProfilPic->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $ProfilPic->move(
                            $this->getParameter('ProfilPics_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                
                $candidat->setProfilPicture($newFilename);
            }

            $entityManager->persist($candidat);
            $entityManager->flush();

            return $this->redirectToRoute('app_candidats_edit', [], Response::HTTP_SEE_OTHER);
        }

         // CALCUL DU POURCENTAGE DE COMPLETION (A REFACTORISER SI J'AI LE TEMPS DONC OUI !)

            $pourcentageCompletion = 0;

            if (!empty($candidat->getGender())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }

            if (!empty($candidat->getFirstName())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }

            if (!empty($candidat->getLastName())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }

            if (!empty($candidat->getAdress())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }
            if (!empty($candidat->getCountry())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }
            if (!empty($candidat->getNationality())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }
            if (!empty($candidat->getPassPortFiles())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }
            if (!empty($candidat->getCv())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }
            if (!empty($candidat->getProfilPicture())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }
            if (!empty($candidat->getCurrentLocation())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }
            if (!empty($candidat->getDateOfBirth())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }
            if (!empty($candidat->getEmail())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }
            if (!empty($candidat->getAviability())) {
               $pourcentageCompletion = $pourcentageCompletion + 1;
             }

            $nbrInput = 13;



            $calcul = intval((($pourcentageCompletion/$nbrInput)*100));

            $candidat->setCompletion($calcul);
            $entityManager->persist($candidat);
            $entityManager->flush();

            // FIN DU CALCUL DE POURCENTAGE DE COMPLETION

        return $this->render('candidats/edit.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
            'calcul' => $calcul,
        ]);
    
  }



    #[Route('/pieces', name: 'app_candidats_pieces', methods: ['GET'])]
    public function pieces(Request $request, EntityManagerInterface $entityManager): Response
    {
        return $this->render('candidats/pieces.html.twig', [
            
        ]);
    }




    #[Route('/{id}', name: 'app_candidats_delete', methods: ['POST'])]
    public function delete(Request $request, Candidats $candidat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_candidats_index', [], Response::HTTP_SEE_OTHER);
    }

}
