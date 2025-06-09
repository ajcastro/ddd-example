<?php

namespace App\Modules\Books\Infrastructure\Models;

use App\Modules\Books\Domain\Entities\Book as EntitiesBook;
use App\Modules\Books\Infrastructure\Models\Collection\BookCollection;
use Illuminate\Database\Eloquent\Attributes\CollectedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[CollectedBy(BookCollection::class)]
class Book extends Model
{
    protected $with = ['author'];

    public function toBook(): EntitiesBook
    {
        return new EntitiesBook(
            id: $this->id,
            title: $this->title,
            author: $this->author->toAuthor()
        );
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}
