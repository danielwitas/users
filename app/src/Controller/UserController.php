<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserManagmentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $userManagmentService;

    public function __construct(UserManagmentService $userManagmentService)
    {
        $this->userManagmentService = $userManagmentService;
    }

    /**
     * @Route("/users", name="users", methods={"GET"})
     */
    public function getUserCollection(Request $request): Response
    {
        $page = $request->query->getInt('page');
        $pagination = $this->userManagmentService->getPaginatedUserCollection($page);
        return $this->render('user/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/users/{id}/disable", name="disable_user", methods={"GET"})
     */
    public function disableUser(Request $request, User $user): Response
    {
        $this->userManagmentService->disableUser($user);
        return $this->redirect($request->headers->get('referer'));
    }
}
