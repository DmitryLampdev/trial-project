<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('users.index', [
            'users' => User::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        // hardcoded password
        $validated['password'] = Hash::make(12345678);
        $create                = User::create($validated);

        if ($create) {
            return redirect()->route('users.index');
        }

        return response('Not found', 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('users.form');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return response()->view('users.form', [
            'user' => User::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $user      = User::findOrFail($id);
        $validated = $request->validated();
        $update    = $user->update($validated);

        if ($update) {
            return redirect()->route('users.index');
        }

        return response('Not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
