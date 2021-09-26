<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SpaController extends Controller
{
    /**
     * auth middleware通す
     * SpaController constructor.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * SPA
     * @param string $path
     * @return Application|Factory|View
     */
    public function index()
    {
        //TODO::UUIDの正規表現
//        $regex = '/\A[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[0-5][a-fA-F0-9]{3}-[089aAbB][a-fA-F0-9]{3}-[a-fA-F0-9]{12}\z/';
//        if ((bool) preg_match($regex, basename($path))) {
//            $path = dirname($path);
//        }
//
//        if (request()->user()->role === config('auth.roles.general_user')) {
//            if (! in_array($path, config('routes.general_user'))) {
//                abort(404);
//            }
//        }

        return view('app');
    }
}
