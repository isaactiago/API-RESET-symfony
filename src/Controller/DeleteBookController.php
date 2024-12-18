<?php 

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeleteBookController extends AbstractController
{

    public function __construct(
        private BookRepository $bookRepository
    )
    {
    }

    #[Route('books/delete/{book}', methods:["DELETE"])]
    public function __invoke(
        int $book,
    ):JsonResponse
    {
        $book = $this->bookRepository->find($book);
        if(null === $book) $this->createNotFoundException();
        $this->bookRepository->remove($book);
        return $this->json([
            "message" => "book delete succefuly",
            "data" => $book
        ]);
    }
}