<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\FeaturedRepository;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    /**
     * @var CatalogueRepository
     */
    protected $repository;

    /**
     * CatalogueController constructor.
     * @param FeaturedRepository $repository
     */
    public function __construct(FeaturedRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = Category::orderBy('type')->get();

        $category = request('category_id', false);

        $details = $this->repository->selectForIndex($category);

        return view('featured.index', compact('details', 'categories'));
    }

    public function pdf()
    {
        $categories = Category::orderBy('type')->get();

        $category = request('category_id', false);

        $details = $this->repository->selectForIndex($category);

        return view('featured.pdf', compact('details', 'categories'));
    }
}
