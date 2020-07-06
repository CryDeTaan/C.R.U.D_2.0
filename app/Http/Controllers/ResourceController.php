<?php

namespace App\Http\Controllers;

use App\Resource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Policies\ResourceContributorPolicy;

class ResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Resource::class, 'resource');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $user = auth()->user();
        $resources = $user->resources()->get();

        return view('actions.resource.read', compact('resources'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actions.resource.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAttributes = request()->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'field'                 => ['required', 'string', 'max:255'],
            'resource_contributor'  => ['exists:users,id'],
        ]);

        $resource_contributor = User::find($validatedAttributes['resource_contributor']);
        $this->authorize('assign', $resource_contributor);

        $resource = Resource::create([
            'name'      => $validatedAttributes['name'],
            'field'     => $validatedAttributes['field'],
            'user_id'   => auth()->id(),
            'entity_id' => auth()->user()->entity_id
        ]);

        $resource->assignUser(auth()->user());
        $resource->assignUser($resource_contributor);

        return view('actions.resource.store', compact('resource'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        return view('actions.resource.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        return view('actions.resource.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        $validatedAttributes = request()->validate([
            'name'      => ['required', 'string', 'max:255'],
            'field'     => ['required', 'string', 'max:255'],
        ]);

        $resource->update($validatedAttributes);

        return view('actions.resource.update', compact('resource'));
    }

    /**
     * A view for deleting a resource, this is not generally part of a resourceful controller
     *
     */
    public function delete()
    {

        /*
         * Bit of a hack to trigger the resourceful UserPolicy because this
         * delete() function is not really part of the C.R.U.D actions.
         */
        $this->authorize('delete', [Resource::class, Resource::first()]);

        $resources = Resource::where('user_id', auth()->id())->get();

        return view('actions.resource.delete', compact('resources'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        /*
            I just want to make sure that the Resource with ID 1 cannot
            be delete, so that this demo app remains working. Deleting
            the last resource will be detrimental to the function of
            this demo application. In normal destroy circumstances,
            the resource will just be deleted as expected.
        */
        if($resource->id !== 1) {
            $resource->delete();
        }

        return view('actions.resource.destroy');
    }
}
