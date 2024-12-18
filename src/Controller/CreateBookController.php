<?php 

namespace App\Controller;

use App\Service\CreateBookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateBookController extends AbstractController
{

    #[Route('books/create', methods:["POST"])]
    public function __invoke(
        Request $request,
        CreateBookService $createBookService,
    ):JsonResponse
    {
        $title = $request->get("title");
        $isbn = $request->get("isbn");
        $data = $createBookService->execute(title:$title, isbn : $isbn);
        return $this->json([
            "message" => "book created succefuly",
            "data" => $data
        ]);
    }
}