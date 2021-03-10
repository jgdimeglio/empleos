<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route("/job")
 */
class JobController extends AbstractController
{

    /**
     * @var Security
     */
    private $security;
    private $authorizationChecker = null;

    public function __construct(Security $security, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->security = $security;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @Route("/", name="job_index", methods={"GET"})
     */
    public function index(JobRepository $jobRepository): Response
    {
        if($this->authorizationChecker->isGranted('ROLE_COMPANY')){
            $user = $this->security->getUser();
            $company = $user->getCompany();

            if(!$company){
                $this->addFlash('danger', 'Para crear empleos primero debe completar los datos de la empresa.');
                return $this->redirectToRoute('company_profile');
            }
            $jobs = $user->getCompany()->getJobs();
        }else{
            $jobs = $jobRepository->findAll();
        }
        return $this->render('job/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * @Route("/new", name="job_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $user = $this->security->getUser();
        $company = $user->getCompany();

        if(!$company){
            $this->addFlash('danger', 'Para crear empleos primero debe completar los datos de la empresa.');
            return $this->redirectToRoute('company_profile');
        }

        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $job->setCompany($company);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($job);
            $entityManager->flush();

            $this->addFlash('success', 'El empleo fue creado correctamente.');

            return $this->redirectToRoute('job_index');
        }

        return $this->render('job/new.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_show", methods={"GET"})
     */
    public function show(Job $job): Response
    {
        return $this->render('job/show.html.twig', [
            'job' => $job,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="job_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Job $job): Response
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'El empleo fue actualizado correctamente.');

            return $this->redirectToRoute('job_index');
        }

        return $this->render('job/edit.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="job_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Job $job): Response
    {
        if ($this->isCsrfTokenValid('delete'.$job->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($job);
            $entityManager->flush();
        }

        return $this->redirectToRoute('job_index');
    }

    /**
     * @Route("/{id}/publish", name="job_publish", methods={"GET","POST"})
     */
    public function publish(JobRepository $jobRepository, $id): Response
    {
        $job = $jobRepository->find($id);

        $job->setpublished(new \DateTime());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($job);
        $entityManager->flush();

        $this->addFlash('success', 'La oferta de trabajo fue publicada correctamente.');

        return $this->redirectToRoute('job_index');
    }
}
