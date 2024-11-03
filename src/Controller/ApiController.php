<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    #[Route('/api/{books}', name: 'app_books')]
    public function index(BookRepository $bookRepository): Response
    {
        $listaBooks = $bookRepository->findAll();
        return $this->json($listaBooks,200);
    }
}
