<?php

declare(strict_types=1);

namespace App\Modules\Books\Domain\Repositories;

use App\Modules\Books\Domain\Queries\BooksQuery;
use App\Modules\Books\Domain\Entities\Book;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BookRepositoryInterface
{
    public function all(): Collection;
    public function get(BooksQuery $query): Collection;
    public function paginate(BooksQuery $query): LengthAwarePaginator;
    public function find(string $id): ?Book;
    public function create(Book $book): Book;
    public function update(Book $book): void;
    public function save(Book $book): Book;
    public function delete(string $id): void;
}
