<?php

declare(strict_types=1);

namespace App\Modules\Books\Domain\Entities;

class Author
{
    public function __construct(
        public string $id,
        public string $name,
        public string $email,
    ) {}
}
