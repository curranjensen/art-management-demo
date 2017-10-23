<?php

namespace App\Http\Controllers;

use App\Category;
use App\Repositories\CatalogueRepository;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    /**
     * @var CatalogueRepository
     */
    protected $repository;

    /**
     * CatalogueController constructor.
     * @param CatalogueRepository $repository
     */
    public function __construct(CatalogueRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = Category::orderBy('type')->get();

        $category = request('category_id', false);

        $details = $this->repository->selectForIndex($category);

        return view('catalogue.index', compact('details', 'categories'));
    }
}
