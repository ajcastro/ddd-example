<?php

declare(strict_types=1);

namespace App\Modules\Books\Domain\Entities;

use Illuminate\Contracts\Support\Arrayable;

class Book implements Arrayable
{
    public function __construct(
        public string $id,
        public string $title,
        public Author $author
    ) {}

    public function toArray(): array
    {
        return (array) $this;
    }
}
