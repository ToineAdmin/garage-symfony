<?php 

namespace App\Data;

class SearchData
{
    public ?string $q = '';

    public ?int $minPrice = null;

    public ?int $maxPrice = null;

    public ?int $minMiles = null;

    public ?int $maxMiles = null;

    public ?int $minYear = null;

    public ?int $maxYear = null;

    public int $page = 1;
}
