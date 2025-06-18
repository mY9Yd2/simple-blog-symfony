<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PostRepository $postRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $postRepository->createPublishedQuery(new \DateTime(), $request->query->getString('search'));
        $page = max(1, $request->query->getInt('page', 1));
        $posts = $paginator->paginate($query, $page, 5);

        return $this->render('home/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
