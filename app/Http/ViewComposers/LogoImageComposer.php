<?php namespace App\Http\ViewComposers;

use App\Detail;
use App\Repositories\DetailRepository;
use Illuminate\View\View;

class LogoImageComposer
{
    /**
     * @var DetailRepository
     */
    protected $repository;

    /**
     * LogoImageComposer constructor.
     * @param DetailRepository $repository
     */
    public function __construct(DetailRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $logoImage = $this->repository->getRandomDetail();

        $view->with(compact('logoImage'));
    }
}