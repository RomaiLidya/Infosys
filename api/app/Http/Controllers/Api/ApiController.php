<?php

namespace App\Http\Controllers\Api;

use App\Hady\Repository\AccessControl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    protected $jsonResponse;

    public function __construct()
    {
        $this->jsonResponse = new JsonResponse();
    }

    public function getAccessControl()
    {
        $user = Auth::user();
        if (!empty($user)) {
            return new AccessControl($user);
        }

        return null;
    }
}
