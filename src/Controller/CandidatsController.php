<?php

namespace App\Controller;

use App\Entity\Candidats;
use App\Form\CandidatsType;
use App\Repository\CandidatsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        if ($user->getCandidats()) {

            $candidat = $user->getCandidats();
            $email = $user->getEmail();
            $candidat->setEmail($email);

        }else {
        
            $candidats = new Candidats;            
            $user->setCandidats($candidats);
            $email = $user->getEmail();
            $candidats->setEmail($email);
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

        return $this->render('candidats/edit.html.twig', [
            'candidat' => $candidat,
            'form' => $form,
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
