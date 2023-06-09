<?php

namespace App\Controller;

use App\Repository\Post\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/', name: 'post.index', methods: ["GET"])]
    public function index(PostRepository $postRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $posts = $postRepository->findPublished(
            $request->query->getInt('page', 1),
            4);

        return $this->render('pages/blog/index.html.twig', [
            'posts' => $posts
        ]);
    }
}
