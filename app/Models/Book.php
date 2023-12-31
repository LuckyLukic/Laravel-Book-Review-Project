<?php

namespace App\Models;

use App\Models\Review;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    public function reviews() //Laravel adds magic and this magic can be recall has a property of book: $book->reviews
    {
        return $this->hasMany(Review::class);
    }

    public function scopeTitle(Builder $query, string $title): Builder // devo sempre mettere scope come prefix per incapsulare una query, mettere il builder e specificare il tipo di return
    {

        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopePopular(Builder $query): Builder
    {
        return $query->withCount('rviews')->orderBy('reviews_count', 'desc')->get();
    }

    public function scopeHighestRated(Builder $query): Builder
    {
        return $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating')->get();
    }
}
