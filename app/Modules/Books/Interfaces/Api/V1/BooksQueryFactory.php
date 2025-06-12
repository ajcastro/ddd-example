<?php

declare(strict_types=1);

namespace App\Modules\Books\Interfaces\Api\V1;

use App\Modules\Books\Domain\Queries\BooksQuery;
use Illuminate\Http\Request;

class BooksQueryFactory
{
    public static function from(array $queryParams): BooksQuery
    {
        return new BooksQuery(
            perPage: intval($queryParams['per_page'] ?? 15),
            page: intval($queryParams['page'] ?? 1),
            search: $queryParams['search'] ?? '',
        );
    }

    public static function fromRequest(Request $request): BooksQuery
    {
        return self::from($request->query());
    }
}
