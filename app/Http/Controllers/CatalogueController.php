<?php

namespace App\Http\Controllers;

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
        $details = $this->repository->selectForIndex();

        return view('catalogue.index', compact('details'));
    }
}
