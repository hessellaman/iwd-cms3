<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('model', User::paginate(20));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    //Voor het aanpassen van de gebruikersrollen, een gebruiker moet zichzelf niet kunnen veranderen vanwege veiligheid.
    public function edit(User $user)
    {
        if (Auth::user()->id == $user->id) {
            return redirect()->route('users.index')->with('status', 'You cannot edit yourself.');
        }

        return view('admin.users.edit', [
            'model' => $user,
            'roles' => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    //Voor het aanpassen van de gebruikersrollen, een gebruiker moet zichzelf niet kunnen veranderen vanwege veiligheid.
    public function update(Request $request, User $user)
    {
        if (Auth::user()->id == $user->id) {
            return redirect()->route('users.index')->with('status', 'You cannot edit yourself.');
        }

        $user->roles()->sync($request->roles);

        return redirect()->route('users.index')->with('status', "$user->name was updated.");        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    
    // Voor het verwijderen van een gebruiker.
    public function destroy(User $user)
    {
        if (Auth::user()->cant('delete', $user)) {
            return redirect()->route('users.index')->with('status', 'You do not have permission to delete that user.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('status', 'The user was deleted.'); 
    }
}
