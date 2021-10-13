<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class UserManagmentService
{
    private const ITEMS_PER_PAGE = 10;
    private EntityManagerInterface $entityManager;
    private PaginatorInterface $paginator;

    public function __construct(EntityManagerInterface $entityManager, PaginatorInterface $paginator)
    {
        $this->entityManager = $entityManager;
        $this->paginator = $paginator;
    }

    public function disableUser(User $user): void
    {
        $user->setDisabled(true);
        $this->entityManager->flush();
    }

    public function getPaginatedUserCollection($page)
    {
        $page = max($page, 1);
        $qb = $this->entityManager->getRepository(User::class)->getPaginatedUserCollection();
        return $this->paginator->paginate($qb, $page, self::ITEMS_PER_PAGE);
    }
}