<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedDomain;
use App\Models\User;
use App\Rules\IsValidDomain;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $paginated = User::where('is_active', 1)->paginate(10);

        return view('admin.users.list',[
            'users' => $paginated
        ]);
    }

    public function blockUser(Request $request)
    {
        $id = $request->get('user_id');

        $user = User::find($id);

        $user->__set('is_active', 0);

        $user->save();

        return redirect(route('admin.users.blocked'));
    }

    public function unBlockUser(Request $request)
    {
        $id = $request->get('user_id');

        $user = User::find($id);

        $user->__set('is_active', 1);

        $user->save();

        return redirect(route('admin.users.blocked'));
    }

    public function invite()
    {
        return view('admin.users.invite');
    }

    public function store(Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $color = substr(md5(rand()), 0, 6);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'color' => $color
        ]);

        event(new Registered($user));

        return redirect(route('admin.users'));

    }

    public function blocked()
    {
        $paginated = User::where('is_active', 0)->paginate(10);

        return view('admin.users.list',[
            'users' => $paginated
        ]);
    }

    public function blackList(Request $request)
    {

        if($request->isMethod('post')){
            $data = $request->validate([
                'domain' => ['required', 'string', 'max:255', new IsValidDomain],
                'message' => ['nullable', 'string', 'max:255'],
            ]);

            $domain = BlockedDomain::create([
                'domain' => $data['domain']
            ]);

            $domain->__set('message', $data['message']);
            $domain->save();

            return redirect(route('admin.users.black_list'));
        }


        $paginated = BlockedDomain::paginate(10);

        return view('admin.users.blackList',[
            'domains' => $paginated
        ]);
    }

    public function blackListRemove($id)
    {
        $domain = BlockedDomain::find($id);
        $domain->delete();

        return redirect(route('admin.users.black_list'));
    }
}
