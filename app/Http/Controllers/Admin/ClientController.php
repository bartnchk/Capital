<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClientRequest;
use App\Models\Common\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    protected $client;
    /**
     * ClientController constructor.
     */
    public function __construct()
    {
        $this->client = new Client;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $clients = Client::paginate(20);

        return view('admin.clients.index', ['clients' => $clients]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('admin.clients.create', ['client' => $client]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.clients.create', ['client' => $this->client]);
    }

    /**
     * @param ClientRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ClientRequest $request)
    {
        $requestData = $request->all();

        $result = $this->client->saveClient($requestData, $request);

        if($result)
            return redirect('admin/clients')->with(['message' => 'Услуга сохранена', 'class' => 'success']);
        else
            return redirect('admin/clients')->with(['message' => 'При сохранении возникла ошибка', 'class' => 'error']);
    }

    /**
     * @param ClientRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ClientRequest $request, $id)
    {
        $requestData = $request->all();

        $this->client = $this->client->findOrFail($id);

        $result = $this->client->saveClient($requestData, $request);

        if($result)
            return redirect('admin/clients')->with(['class' => 'success', 'message' => 'Услуга сохранена']);
        else
            return redirect('admin/clients')->with('error', 'При сохранении возникла ошибка.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAll(Request $request)
    {
        if( $request->clients && count($request->clients) ){

            $this->client->destroy($request->clients);

            return redirect()->route('clients')->with(['message' => 'Услуги удалены', 'class' => 'success']);

        } else {

            return back()->with(['message' => 'Не выбрано ни одной услуги', 'class' => 'warning']);

        }
    }

    /**
     * @param Request $request
     */
    public function deleteImage(Request $request)
    {
        dd($request);
        $this->client->deleteImage( $request->get('src') );
    }

    /**
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        if ( $client->delete() )
        {
            return response()->json( [
                "class" => "success", "message" => 'Услуга удалена'
            ] );
        }
    }
}
