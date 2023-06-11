<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact_Item;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use Auth;
use App\Notifications\AccountVerification;
use Illuminate\Support\Facades\Notification;
use App\Mail\accountVEmail;
use Dompdf\Dompdf;
class UserController extends Controller
{
    public function ShowUser()
    {
        $user = User::get();
        return $user;
    }
    

    public function loginUser(Request $request)
    {
        $login_user = User::where([
            ['email', '=', $request->email],
            ['password', '=' , sha1($request->password)],
            ['type','=',99]
            ])->first();
        if($login_user)
        {   
           
            Auth::login($login_user);
            return redirect('admin');
        }
        else
        {
            abort(403);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
      }

    public function AdminPanel()
    {
        $user = User::where('type', '=', 0)->get();
        return view('admin', compact('user'));
    }

    public function registeration()
    {
        $state = State::get();
        $city = City::get();
        return view('registeration', compact([
            'state',
            'city'
        ]));
    }

    public function RegisterUser(Request $request)
    {
        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->mobile = $request->mobile;
        $new_user->email = $request->email;
        $new_user->city = $request->city;
        $new_user->password = sha1($request->password);
        $new_user->state = $request->state;
        $new_user->description = $request->desc;
        $new_user->type = 0;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/media/avatars'), $imageName);
            $new_user->image = $imageName;
        }
        // Save the user
        $new_user->save();
        return redirect('/');
    }


    public function EditUser($id)
    {
        $user = User::where('id','=',$id)->first();
        if($user)
        {
            $user_state = State::where('id','=',$user->state)->first();
            $user_city = City::where('id','=',$user->city)->first();
            $state = State::get();
            $city = City::get();
            return view('edit', compact([
                'user',
                'state',
                'city',
                'user_state',
                'user_city'
            ]));
        }
        else
        {
            abort(404);
        }
    }
    
    public function UpdateUser(Request $request,$id)
    {
        $user = User::where('id','=',$id)->first();
        if($user)
        {
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $user->image = $imageName;
            }
            $user->save();
            return redirect('admin');
        }
        else
        {
            abort(404);
        }
    }

    public function DeleteUser($id)
    {
        $user = User::where('id','=',$id)->first();
        if($user)
        {
            $user->delete();
            return redirect('admin');
        }
        else
        {
            abort(404);
        }
    }


    public function downloadpdf()
    {
        $users = User::select('name', 'mobile', 'email')->get();

        $html = view('pdf', compact('users'))->render();

        $pdf = new Dompdf();
        $pdf->loadHtml($html);

        $pdf->setPaper('A4');
        $pdf->render();

        return $pdf->stream('users.pdf');

    }
        
}


