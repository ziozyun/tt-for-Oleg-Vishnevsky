<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with('city')
            ->withCount('contacts')
            ->join('cities', 'cities.id', '=', 'clients.city_id')
            ->orderBy('cities.name', 'asc')
            ->orderByDesc('contacts_count')
            ->paginate(25);

        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->only(['first_name', 'last_name', 'city_id']));

        foreach ($request->contacts as $contact) {
            $client->contacts()->create($contact);
        }

        return response()->json($client, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::with('contacts', 'city')
            ->findOrFail($id);
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, string $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->only(['first_name', 'last_name', 'city_id']));

        $client->contacts()->delete();
        foreach ($request->contacts as $contact) {
            $client->contacts()->create($contact);
        }

        return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return response()->json(null, 204);
    }
}
