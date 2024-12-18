<?php

namespace App\Controller;

use App\Repository\BookRepository;
use PHPStan\PhpDocParser\Ast\Type\ThisTypeNode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    public function __construct(
        private BookRepository $bookRepository,
    )
    {
    }

    #[Route('books',name:"app_book", methods:["GET"])]
    public function index():JsonResponse
    {
        return $this->json([
            "data" => $this->bookRepository->findAll(),
        ]);
    }
}
