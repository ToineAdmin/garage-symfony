<?php 

namespace App\Data;

class SearchData
{
    /**
     * @var string
     */
    public $q ='';

    /**
     * @var null|integer
     */
    public $minPrice;

    /**
     * @var null|integer
     */
    public $maxPrice;

    /**
     * @var null|integer
     */
    public $minMiles;

    /**
     * @var null|integer
     */
    public $maxMiles;

        /**
     * @var null|integer
     */
    public $minYear;

    /**
     * @var null|integer
     */
    public $maxYear;


    /**
     * @var integer
     */
    public $page = 1;

}


