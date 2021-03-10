<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Province;
use App\Entity\Location;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{

    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    /**
     * @Route("/", name="company_index", methods={"GET"})
     */
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('company/index.html.twig', [
            'companies' => $companyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/profile", name="company_profile", methods={"GET","POST"})
     */
    public function profile(Request $request): Response
    {
        $user = $this->security->getUser();
        $company = $user->getCompany();

        if(!$company)
            $company = new Company();

        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $company->setUser($user);
            $entityManager = $this->getDoctrine()->getManager();

            $provinceId = $form['province_in_form']->getData();
            $locationId = $form['location_in_form']->getData();



            $province = $entityManager->getRepository(Province::class)->find($provinceId);
            $location = $entityManager->getRepository(Location::class)->find($locationId);

            $company->setProvince($province);
            $company->setLocation($location);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($company);
            $entityManager->flush();

            $this->addFlash('success', 'Datos actualizados correctamente.');

            return $this->redirectToRoute('company_profile');
        }

        return $this->render('company/new.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_show", methods={"GET"})
     */
    public function show(Company $company): Response
    {
        return $this->render('company/show.html.twig', [
            'company' => $company,
        ]);
    }
}
