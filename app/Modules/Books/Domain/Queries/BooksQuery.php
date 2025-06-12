<?php

declare(strict_types=1);

namespace App\Modules\Books\Domain\Queries;

class BooksQuery
{
    public function __construct(
        public int $perPage,
        public int $page,
        public string $search,
        public string $authorId = '',
    ) {}
}
