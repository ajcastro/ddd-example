<?php

declare(strict_types=1);

namespace App\Modules\Books\Infrastructure\Models\Collection;

use App\Modules\Books\Infrastructure\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookCollection extends Collection
{
    public function toBooks(): Collection
    {
        return $this->map(function (Book $item) {
            return $item->toBook();
        });
    }
}
