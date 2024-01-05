<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title'); //input is used to retrieve a specific item of input data.
        $filter = $request->input('filter', ''); //if is not set it  as default empty value

        $books = Book::when($title, function ($query, $title) { //in the context of when (it applies to other contexts) $query is an istance of the query Builder automatically passed
            return $query->title($title); // title recals our scoped query scopedTitle
        });

        $books = match ($filter) {

            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6month' => $books->popularLast6Month(),
            'highest_rated_last_month' => $books->highestRatedLasMonth(),
            'highest_rated_last_6month' => $books->highestRatedLast6Months(),
            default => $books->latest()->withAvgRating()->withReviewsCount()

        };

        $cacheKey = 'books:' . $filter . ':' . $title;
        $books =
            // cache()->remember(
            // $cacheKey,
            // 3600,
            // fn() =>
            $books->get();

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        $cacheKey = 'book:' . $id;

        $book = cache()->remember($cacheKey, 3600, fn() => Book::with(['reviews' => fn($query) => $query->latest()])
            ->withAvgRating()->withReviewsCount()->FindOrFail($id));


        return view('books.show', ['book' => $book]);

        //Eager

        // $bookWithReviews = Book::with([
        //     'reviews' => function ($query) {
        //         $query->latest();
        //     }
        // ])->findOrFail($book);

        // return view('books.show', ['book' => $bookWithReviews]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
