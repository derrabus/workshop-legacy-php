<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class CategoriesController
{
    private $em;
    private $twig;

    public function __construct(EntityManagerInterface $em, Environment $twig)
    {
        $this->twig = $twig;
        $this->em = $em;
    }

    /**
     * @Route("/admin/categories", methods={"GET"})
     *
     * @return Response
     */
    public function __invoke(): Response
    {
        $categories = $this->em
            ->createQueryBuilder()
            ->from(Category::class, 'c')
            ->select('c')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult();

        return new Response(
            $this->twig->render('admin/categories.html.twig', ['categories' => $categories])
        );
    }
}
