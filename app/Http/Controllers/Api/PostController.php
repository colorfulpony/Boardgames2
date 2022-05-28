<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __invoke()
    {
        return [
            'test' => 'test',
            'nwer' => 'asdagsf',
            'asdag' => 'asg'
        ];
    }
}
