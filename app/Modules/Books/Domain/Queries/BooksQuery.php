<?php

declare(strict_types=1);

namespace App\Modules\Books\Domain\Queries;

use Illuminate\Http\Request;

class BooksQuery
{
    public function __construct(
        public int $perPage,
        public int $page,
        public string $search,
    ) {}

    public static function from(Request $request): self
    {
        return new self(
            perPage: intval($request->per_page ?: 15),
            page: intval($request->page ?: 1),
            search: $request->search ?? ''
        );
    }
}
