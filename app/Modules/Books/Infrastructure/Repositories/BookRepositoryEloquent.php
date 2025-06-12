<?php

declare(strict_types=1);

namespace App\Modules\Books\Infrastructure\Repositories;

use App\Modules\Books\Domain\Queries\BooksQuery;
use App\Modules\Books\Domain\Entities\Book;
use App\Modules\Books\Domain\Repositories\BookRepositoryInterface;
use App\Modules\Books\Infrastructure\Models\Author as AuthorModel;
use App\Modules\Books\Infrastructure\Models\Book as BookModel;
use App\Modules\Books\Infrastructure\Models\Collection\BookCollection;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BookRepositoryEloquent implements BookRepositoryInterface
{

    public function all(): Collection
    {
        /** @var BookCollection */
        $bookModels = BookModel::all();

        return $bookModels->toBooks();
    }

    public function get(BooksQuery $query): Collection
    {
        /** @var BookCollection */
        $bookModels = $this->query($query)->get();

        return $bookModels->toBooks();
    }

    public function paginate(BooksQuery $query): LengthAwarePaginator
    {
        $paginator = $this->query($query)->paginate(
            perPage: $query->perPage,
            page: $query->page,
        );

        /** @var BookCollection */
        $bookModels = $paginator->getCollection();

        return $paginator->setCollection($bookModels->toBooks());
    }

    private function query(BooksQuery $query): Builder
    {
        $builder = BookModel::query();

        $builder->when($query->search, fn(Builder $q) => $q->where('title', 'like', '%' . $query->search . '%'));
        $builder->when($query->authorId, fn(Builder $q) => $q->where('author_id', $query->authorId));

        return $builder;
    }

    public function find(string $id): Book
    {
        return BookModel::query()
            ->where('id', $id)
            ->firstOrFail()
            ?->toBook();
    }

    public function create(Book $book): Book
    {
        return $book; // TODO: Implement create method
    }

    public function update(Book $book): void
    {
        // TODO
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

    public function delete(string $id): void
    {
        // TODO
    }
}
