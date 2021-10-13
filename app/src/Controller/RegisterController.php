<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\UserRegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST", "GET"})
     */
    public function index(Request $request, UserRegisterService $userRegisterService): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $userRegisterService->registerUser($user);
            $this->addFlash(
                'success',
                'Success! You can now log in.'
            );
            return $this->redirectToRoute('login');
        }
        return $this->renderForm('register/index.html.twig', [
            'form' => $form,
        ]);
    }
}
