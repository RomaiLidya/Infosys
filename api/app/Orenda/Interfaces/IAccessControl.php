<?php

namespace App\Orenda\Interfaces;

// Access control interface to help business logic to determine what to do
// with various permission
interface IAccessControl
{
    public function hasAccess($module, $accessLevel);
    public function hasAccesses($listName);
}
