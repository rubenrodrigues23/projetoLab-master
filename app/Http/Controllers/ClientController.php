<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Component\ErrorHandler\Debug;
use PDF;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(10);
        return view('clients.index', compact('clients'));
    }
    public function indexMyAdverts()
    {

        $clients = Client::paginate(10);
        $photos = Photo::all();
        return view('clients.myAdverts', compact('clients', 'photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        

        Client::create([
            'name' => $request['name'],
            'price' => $request['price'],
            'description' => $request['description'],
            'image' => $request['image'],
            'user_id' => auth()->user()->getAuthIdentifier(),
        ]);//guarddar a imagem 
        return redirect()->route('clients.myadverts')->with('success', 'Advert created succesfully');
    }

    

    public function uploadImage(Request $request, $id)
    {
        $client = Client::find($id);
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images', $filename, 'public');//nao esta a guardar na storage
            $client->update(['image' => $filename]);
            
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $photos = Photo::all();
        return view('clients.show', compact('client', 'photos'));
    }

    public function showAdmin(Client $client)
    {
        return view('clients.showAdmin', ['client' => $client]);
    }

    public function showMyAdverts(Client $client)
    {
        $photos = Photo::all();
        return view('clients.showMyAdverts', compact('client', 'photos'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit', ['client' => $client]);
    }

    public function editAdmin(Client $client)
    {
        return view('clients.editAdmin', ['client' => $client]);
    }

    public function editMyAdverts(Client $client)
    {
        return view('clients.editMyAdverts', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        $client->update($request->all());

        return redirect()->route('clients.myadverts')->with('success', 'Ardvert updated successfully');
    }

    public function updateAdmin(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Ardvert updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.myadverts')->with('success', 'Advert deleted successfully');
    }

    public function destroyAdmin(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Advert deleted successfully');
    }

    public function search(Request $request)
    {

        $query = $request->input('query');
        $results = Client::where('name', 'like', "%$query%")->get();

        return view('clients.search', ['results' => $results]);
    }
}
