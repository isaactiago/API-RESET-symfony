<?php

namespace App\Service;

use App\Entity\Book;
use App\Repository\BookRepository;

class CreateBookService 
{
    public function __construct(
        private BookRepository $bookRepository,
    )
    {
    }

    public function execute(string $title, string $isbn):Book
    {
        $book = new Book($title,$isbn);
        return $this->bookRepository->add($book);
    }
}