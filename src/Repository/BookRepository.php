<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function add(Book $book):Book
    {
        $this->getEntityManager()->persist($book);
        $this->getEntityManager()->flush();
        return $book;
    }

    public function remove(Book $book):void
    {
        $this->getEntityManager()->remove($book);
        $this->getEntityManager()->flush();
    }
}
