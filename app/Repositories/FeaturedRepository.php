<?php namespace App\Repositories;

interface FeaturedRepository
{
    public function selectForIndex($category = false);
}