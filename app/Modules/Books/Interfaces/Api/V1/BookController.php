<?php

namespace App\Modules\Books\Interfaces\Api\V1;

use App\Http\Controllers\Controller;
use App\Modules\Books\Domain\Queries\BooksQuery;
use App\Modules\Books\Domain\Repositories\BookRepositoryInterface;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request, BookRepositoryInterface $bookRepository)
    {
        return $bookRepository->paginate(BooksQueryFactory::fromRequest($request));
    }

    public function show(string $bookId, BookRepositoryInterface $bookRepository)
    {
        return $bookRepository->findById($bookId);
    }
}
