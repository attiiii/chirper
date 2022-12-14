<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChirpStoreRequest;
use App\Models\Chirp;
use Inertia\Inertia;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ChirpStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChirpStoreRequest $request)
    {
        $request->user()->chirps()->create($request->validated());

        return redirect(route('chirps.index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ChirpStoreRequest $request
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function update(ChirpStoreRequest $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        $chirp->update($request->validated());

        return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chirp  $chirp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
