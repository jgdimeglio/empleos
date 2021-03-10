<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AuthController extends AbstractController
{

    private $tokenManager;
    private $authorizationChecker = null;

    public function __construct(CsrfTokenManagerInterface $tokenManager = null, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->tokenManager = $tokenManager;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @Route("/login", name="login")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/auth/success", name="auth_success")
     */
    public function success()
    {
        if($this->authorizationChecker->isGranted('ROLE_STUDENT')){
            return $this->redirectToRoute('student_profile');
        }
        if($this->authorizationChecker->isGranted('ROLE_COMPANY')){
            return $this->redirectToRoute('company_profile');
        }
        if($this->authorizationChecker->isGranted('ROLE_ADMIN')){
            return $this->redirectToRoute('job_index');
        }
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}
