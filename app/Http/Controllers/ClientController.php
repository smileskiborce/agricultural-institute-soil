<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class ClientController extends Controller
{

    public function index(Request $request): Response
    {
//        $this->authorize('viewAny', Client::class);
        $search = $request->get('search');

        $clients = Client::query()
            ->select('id', 'name','address', 'phone', 'fax', 'email')
            ->search($search, ['name', 'contact_name', 'email'], ['name', 'contact_name', 'email'])
            ->paginate(20)
            ->withQueryString();
        return Inertia::render('Client/Index', compact('clients'));
    }


    public function store(ClientRequest $request): RedirectResponse
    {
//        dd($request );

//        $this->authorize('create', Client::class);

            Client::query()
                ->create($request->validated());


        return back()->with('success', 'Успешно го креиравте комитентот');
    }
//
//
    public function update(Client $client, ClientRequest $request): RedirectResponse
    {
//        $this->authorize('update', Client::class);

        DB::transaction(function () use ($client, $request) {
            $client->update($request->validated());
        });

        return back()->with('success', 'Успешно го изменивте избраниот комитент');
    }
//
//    /**
//     * @throws AuthorizationException
//     */
    public function destroy(Client $client): RedirectResponse
    {
//        $this->authorize('delete', Client::class);
//


        $client->delete();

        return back()->with('success', 'Успешно го избришавте избраниот комитент');
    }
}
