<?php

namespace App\Orenda\Interfaces;

// Business logic for saving and deleting
interface IRepository {
    public function getModel();
    public function save();
    public function delete();
}
