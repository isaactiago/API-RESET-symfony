<?php 

namespace App\Controller;

use App\Repository\BookRepository;
use App\Service\CreateBookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UpdateBookController extends AbstractController
{

    public function __construct(
        private BookRepository $bookRepository
    )
    {
    }

    #[Route('books/update/{book}', methods:["PUT","PATCH"])]
    public function __invoke(
        Request $request,
        int $book,
    ):JsonResponse
    {
        $book = $this->bookRepository->find($book);

        if(null === $book) $this->createNotFoundException();
        
        $title = $request->get("title");
        $isbn = $request->get("isbn");

        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setCreatedAt(new \DateTimeImmutable("now",new \DateTimeZone("America/Sao_Paulo")));

        $this->bookRepository->add($book);
      
        return $this->json([
            "message" => "book updated succefuly",
            "data" => $book
        ]);
    }
}