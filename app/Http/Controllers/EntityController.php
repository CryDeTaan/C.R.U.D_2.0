<?php

namespace App\Http\Controllers;

use App\Entity;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Entity::class, 'entity');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = Entity::all();

        return view('actions.entity.read', compact('entities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actions.entity.create');
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
            'name'      => ['required', 'string', 'max:255'],
            'field'     => ['required', 'string', 'max:255'],
        ]);

        $entity = Entity::create([
            'name'      => $validatedAttributes['name'],
            'field'     => $validatedAttributes['field'],
            'user_id'   => auth()->id()
        ]);

        return view('actions.entity.store', compact('entity'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function show(Entity $entity)
    {
        return view('actions.entity.show', compact('entity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function edit(Entity $entity)
    {
        return view('actions.entity.edit', compact('entity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity)
    {
        $validatedAttributes = request()->validate([
            'name'      => ['required', 'string', 'max:255'],
            'field'     => ['required', 'string', 'max:255'],
        ]);

        $entity->update($validatedAttributes);

        return view('actions.entity.update', compact('entity'));
    }

    /**
     * A view for deleting a resource, this is not generally part of a resourceful controller
     *
     */
    public function delete()
    {
        /*
        * Bit of a hack to trigger the resourceful EntityPolicy because this
        * delete() function is not really part of the C.R.U.D actions.
        */
        $this->authorize('delete', [Entity::class, Entity::first()]);

        $entities = Entity::all();

        return view('actions.entity.delete', compact('entities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entity $entity)
    {
        /*
            I just want to make sure that the 'built-in' entity cannot
            be delete, so that this demo app remains working. Deleting
            the last resource will be detrimental to the function of
            this demo application. In normal destroy circumstances,
            the resource will just be deleted as expected.
        */
        if(!$entity->id === 1) {
            $entity->delete();
        }

        return view('actions.entity.destroy');
    }
}
