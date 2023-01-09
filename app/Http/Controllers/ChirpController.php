<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChirpStoreRequest;
use App\Models\Chirp;
use App\Services\Uploader\UploadService;
use Illuminate\Support\Facades\Storage;
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
            'chirps' => Chirp::with(['user:id,name', 'attachment:chirp_id,disk,path'])->latest()->get(),
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
        $chirp = $request->user()->chirps()->create($request->validated());

        if ($request->hasFile('file')) {
            $file = (new UploadService)->chirpAttachment(
                file: $request->file('file')
            );

            $chirp->attachment()->create($file->toArray());
        }

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

        if ($chirp->attachment) {
            Storage::disk($chirp->attachment->disk)->delete($chirp->attachment->path);

            $chirp->attachment()->delete();
        }

        $chirp->delete();

        return redirect(route('chirps.index'));
    }
}
