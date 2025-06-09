<?php

namespace App\Modules\Books\Infrastructure\Models;

use App\Modules\Books\Domain\Entities\Author as EntitiesAuthor;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function toAuthor(): EntitiesAuthor
    {
        return new EntitiesAuthor(
            id: $this->id,
            name: $this->name,
            email: $this->email,
        );
    }
}
