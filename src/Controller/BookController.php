<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BookRepository;
use DateTimeImmutable;


class BookController extends AbstractController
{
    #[Route('/books', name: 'book_list', methods:['GET'])]
    public function index( BookRepository $bookRepository): Response
    {
        return $this->render('book/index.html.twig', [
            "data" => $bookRepository->findAll(),
        ]);
    }

    #[Route('/books/{book}', name: 'book_single', methods:['GET'])]
    public function single( int $book , BookRepository $bookRepository): Response
    {
        $book = $bookRepository->find($book);

        if(!$book){
           throw  $this->createNotFoundException("nao encontrado");
        }
        return $this->render('book/index.html.twig', [
            "data" => $book,
        ]);
    }

    #[Route('/books_show', name: 'books_show')]
    public function show(
        ): Response
    {
        return $this->render('book/cadastrar.html.twig');
    }

    #[Route('/books_create', name: 'books_crate', methods:"POST")]
    public function create(
        Request $request, 
        BookRepository $bookRepository
        ): Response
    {
        $data = $request->request->all();
    

        $book = new Book();
        $book->setTitle($data['title']);
        $book->setIsbn($data['isbn']);
    
        $book->setCreatedAt(new DateTimeImmutable("now", new \DateTimeZone('America/Sao_Paulo')));
        $book->setUpdatedAt(new DateTimeImmutable("now", new \DateTimeZone('America/Sao_Paulo')));
        
        $bookRepository->add($book);
  
       
        return $this->render('book/cadastrar.html.twig', [
            'message' => 'Book creado com sucesso',
        ]); 
    }
}
