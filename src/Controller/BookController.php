<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class BookController extends AbstractController
{
    #[Route('api/books', name: 'allBook', methods: ['GET'])]
    public function getAllBooks(BookRepository $bookRepository, SerializerInterface $serializer): JsonResponse
    {
        $bookList = $bookRepository->findAll();

        $jsonBookList = $serializer->serialize($bookList, 'json', ['groups' => 'getBooks']);

        return new JsonResponse($jsonBookList, Response::HTTP_OK, [], true);
    }

//    // Route "SANS le PARAMCONVERTER"
//    #[Route('/api/books/{id}', name: 'detailBook', methods: ['GET'])]
//    public function getDetailBook(int $id, SerializerInterface $serializer, BookRepository $bookRepository): JsonResponse {
//
//        $book = $bookRepository->find($id);
//        if ($book) {
//            $jsonBook = $serializer->serialize($book, 'json');
//            return new JsonResponse($jsonBook, Response::HTTP_OK, [], true);
//        }
//        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
//    }

    // Route "AVEC le PARAMCONVERTER"
    #[Route('/api/books/{id}', name: 'book', methods: ['GET'])]
    public function getBook(Book $book, SerializerInterface $serializer): JsonResponse
    {
        $jsonBook = $serializer->serialize($book, 'json', ['groups' => 'getBooks']);
        return new JsonResponse($jsonBook, Response::HTTP_OK, [], true);
    }
}
