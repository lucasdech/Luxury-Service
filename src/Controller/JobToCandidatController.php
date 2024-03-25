<?php

namespace App\Controller;

use App\Entity\Candidats;
use App\Entity\JobToCandidat;
use App\Form\JobToCandidatType;
use App\Repository\JobToCandidatRepository;
use App\Repository\CandidatsRepository;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/job/to/candidat')]
class JobToCandidatController extends AbstractController
{
    #[Route('/', name: 'app_job_to_candidat_index', methods: ['GET'])]
    public function index(JobToCandidatRepository $jobToCandidatRepository): Response
    {
        return $this->render('job_to_candidat/index.html.twig', [
            'job_to_candidats' => $jobToCandidatRepository->findAll(),
        ]);
    }

    // ci-dessous pour ajouter une candidature 

    #[Route('/new', name: 'app_job_to_candidat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, CandidatsRepository $candidatsRepository, JobOfferRepository $jobOfferRepository): Response
    {

        $jobToCandidat = new JobToCandidat();
        // $form = $this->createForm(JobToCandidatType::class, $jobToCandidat);
        // $form->handleRequest($request);

        // partie candidats id 

            $user = $this->getUser();

            $candidat = $user->getcandidats();

            $candidat_id = $candidat->getId();
                        
            $candidatObject = $candidatsRepository->find($candidat_id);
        
        // partie job offer id 

           $idJobOffer = $request->request->get('jobOffer_ID');
        
            $jobOfferObject = $jobOfferRepository->find($idJobOffer);

        
            // set pour les deux ID a rentrer 

            $jobToCandidat->setIdCandidat($candidatObject);
            $jobToCandidat->setIdJobOffer($jobOfferObject);

            $entityManager->persist($jobToCandidat);
            $entityManager->flush();

            return $this->redirectToRoute('app_job_offer_index', [], Response::HTTP_SEE_OTHER);       
    }

    #[Route('/{id}', name: 'app_job_to_candidat_show', methods: ['GET'])]
    public function show(JobToCandidat $jobToCandidat): Response
    {
        return $this->render('job_to_candidat/show.html.twig', [
            'job_to_candidat' => $jobToCandidat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_job_to_candidat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JobToCandidat $jobToCandidat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JobToCandidatType::class, $jobToCandidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_job_to_candidat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_to_candidat/edit.html.twig', [
            'job_to_candidat' => $jobToCandidat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_job_to_candidat_delete', methods: ['POST'])]
    public function delete(Request $request, JobToCandidat $jobToCandidat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobToCandidat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($jobToCandidat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_job_to_candidat_index', [], Response::HTTP_SEE_OTHER);
    }
}
