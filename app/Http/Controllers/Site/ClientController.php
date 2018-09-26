<?php

namespace App\Http\Controllers\Site;

use App\Models\Common\Client;
use App\Traits\Scopes;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    use Scopes;

    public function index()
    {
        $clients = Client::published()->get();

        return view('site.clients.index', ['clients' => $clients]);
    }

    public function show($alias)
    {
        $client = Client::published()->whereAlias($alias)->firstOrFail();
        return view('site.clients.show', ['client' => $client]);
    }
}
