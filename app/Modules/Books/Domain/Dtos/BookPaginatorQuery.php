<?php

declare(strict_types=1);

namespace App\Modules\Books\Domain\Dtos;

use Illuminate\Http\Request;

class BookPaginatorQuery
{
    public function __construct(
        public int $perPage,
        public int $page,
        public string $search,
    ) {}

    public static function from(Request $request): self
    {
        return new self(
            perPage: $request->per_page ?: 15,
            page: $request->page ?: 1,
            search: $request->search ?? ''
        );
    }
}
