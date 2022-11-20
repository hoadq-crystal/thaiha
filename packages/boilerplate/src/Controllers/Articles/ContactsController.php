<?php

namespace Sebastienheyd\Boilerplate\Controllers\Articles;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Sebastienheyd\Boilerplate\Models\Contacts;

class ContactsController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('boilerplate::contacts.list');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Application|Factory|View
     */

    public function create()
    {
        return view('boilerplate::contacts.create');
    }

    public function createContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:contacts',
            'email' => 'required|unique:contacts',
            'dataContent' => 'required',
        ]);
        Contacts::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'content' => $request->dataContent,
        ]);
        return redirect()->route('boilerplate.contacts.index')
            ->with('growl', [__('boilerplate::contacts.list.successcreate'), 'success']);
    }

    public function edit($id)
    {
        $contact = Contacts::findOrFail($id);
        return view('boilerplate::contacts.edit', [
            'contact' => $contact,
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws ValidationException
     */
    public function update($id, Request $request): RedirectResponse
    {
        $contact = Contacts::find($id);
        $contact->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'content' => $request->contentData,
        ]);
        $contact->update();
        return redirect()->route('boilerplate.contacts.index', $contact)
            ->with('growl', [__('boilerplate::contacts.successmod'), 'success']);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $article = Articles::findOrFail($id);
        return response()->json(['success' => $article->delete() ?? false]);
    }
}
