<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JobRepository;
use App\Repository\StudentRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(JobRepository $jobRepository): Response
    {
        return $this->render('home/job.html.twig', [
            'jobs' => $jobRepository->findPublished(),
        ]);
    }

    /**
     * @Route("/home/student", name="home_student")
     */
    public function student(StudentRepository $studentRepository): Response
    {
        return $this->render('home/student.html.twig', [
            'students' => $studentRepository->findPublished(),
        ]);
    }
}
