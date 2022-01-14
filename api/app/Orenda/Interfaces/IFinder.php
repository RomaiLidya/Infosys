<?php

namespace App\Orenda\Interfaces;

// Business logic for data finder(eloquent/model)
interface IFinder {
    // Find by keyword
    public function setKeyword($keyword);
    // Order by
    public function orderBy($columnName, $orderBy);
    // Get eloquent object
    public function get();
}
