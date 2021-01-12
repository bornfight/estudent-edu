<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $results = [
            [
                'title' => 'Title 1',
                'content' => 'Content 1 Content 1 Content 1 Content 1 Content 1 Content 1'
            ],
            [
                'title' => 'Title 2',
                'content' => 'Content 2 Content 2 Content 2 Content 2 Content 2 Content 2'
            ]
        ];

        return $this->render('home/homepage.html.twig', [
            'results' => $results
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->json([
            'message' => 'About page!',
        ]);
    }
}
