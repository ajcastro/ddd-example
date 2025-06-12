<?php

declare(strict_types=1);

namespace App\Modules\Books\Infrastructure\Repositories;

use App\Modules\Books\Domain\Queries\BooksQuery;
use App\Modules\Books\Domain\Entities\Book;
use App\Modules\Books\Domain\Repositories\BookRepositoryInterface;
use App\Modules\Books\Infrastructure\Models\Author as AuthorModel;
use App\Modules\Books\Infrastructure\Models\Book as BookModel;
use App\Modules\Books\Infrastructure\Models\Collection\BookCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BookRepositoryEloquent implements BookRepositoryInterface
{
    public function paginate(BooksQuery $query): LengthAwarePaginator
    {
        $paginator = BookModel::query()
            ->where('title', 'like', '%' . $query->search . '%')
            ->paginate(
                perPage: $query->perPage,
                page: $query->page
            );

        return $paginator->setCollection(
            $paginator->getCollection()->map(fn(BookModel $book) => $book->toBook())
        );
    }

    public function findById(string $id): Book
    {
        return BookModel::query()
            ->where('id', $id)
            ->firstOrFail()
            ?->toBook();
    }

    public function findByTitle(string $title): ?Collection
    {
        /** @var BookCollection */
        $bookModels = BookModel::query()
            ->where('title', 'like', '%' . $title . '%')
            ->paginate()
            ->get();

        return $bookModels->toBooks();
    }

    public function findByAuthorId(string $authorId): ?Collection
    {
        /** @var BookCollection */
        $bookModels = BookModel::query()
            ->where('author_id', $authorId)
            ->get();

        return $bookModels->toBooks();
    }

    public function all(): Collection
    {
        /** @var BookCollection */
        $bookModels = BookModel::all();

        return $bookModels->toBooks();
    }

    public function save(Book $book): Book
    {
        $author = AuthorModel::query()->firstOrUpdate(
            ['id' => $book->author->id],
            ['name' => $book->author->name]
        );

        $bookModel = BookModel::query()->firstOrNew(['id' => $book->id]);

        $bookModel->title = $book->title;
        $bookModel->author_id = $author->id;

        $bookModel->save();

        return $bookModel->toBook();
    }

    public function delete(string $id): void {}

    public function update(Book $book): void {}
}
