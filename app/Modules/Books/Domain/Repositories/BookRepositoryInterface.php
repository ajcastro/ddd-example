<?php

declare(strict_types=1);

namespace App\Modules\Books\Domain\Repositories;

use App\Modules\Books\Domain\Queries\BooksQuery;
use App\Modules\Books\Domain\Entities\Book;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BookRepositoryInterface
{
    public function paginate(BooksQuery $query): LengthAwarePaginator;
    public function find(string $id): ?Book;
    public function findByTitle(string $title): ?Collection;
    public function findByAuthorId(string $authorId): ?Collection;
    public function all(): Collection;
    public function save(Book $book): Book;
    public function delete(string $id): void;
    public function update(Book $book): void;
}
