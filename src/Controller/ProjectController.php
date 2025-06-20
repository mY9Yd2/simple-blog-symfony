<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectController extends AbstractController
{
    #[Route('/project', name: 'app_project')]
    public function index(ProjectRepository $projectRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $projectRepository->createPublishedQuery(new \DateTime(), $request->query->getString('search'));
        $page = max(1, $request->query->getInt('page', 1));
        $projects = $paginator->paginate($query, $page, 12);

        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }
}
