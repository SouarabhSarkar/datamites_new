<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use App\Models\Contact_Item;
use Auth;
use Carbon;
use DB;
use App\Notifications\AccountVerification;
use Illuminate\Support\Facades\Notification;
use App\Mail\accountVEmail;
class RegisterController extends Controller
{
    // public function create(Request $request)
    // {
    //     $add_user = new User();
    //     $add_user->id = $request->id;
    //     $add_user->contact_id = $request->contact_id;
       
    // }
    // public function register_user(Request $request)
    // {
    //     // dd($request->all());
    //     $contact_item = Contact_Item::where('value', '=', $request->email)->first();
    //     if($contact_item)
    //     {
    //         return "already Exist";
    //     }
    //     else
    //     {
    //         // dd($request->all());
    //         $contact = new Contact();
    //         $contact->name = $request->name;
    //         $contact->dob = $request->dob;
    //         $contact->role - $request->role;
    //         $contact->save();

 
    //         $contact_item_type = new Contact_Item();  
    //         $contact_item_type->belongs_to = $contact->id; 
    //         $contact_item_type->value = $request->email;
    //         $contact_item_type->status = $request->status;
    //         $contact_item_type->verified_on = $request->verified_on;
    //         $contact_item_type->released_on = $request->released_on;
    //         $contact_item_type->created_by = 1;
    //         $contact_item_type->save();


    //         $user = new User();
    //         $user->contact_id = $contact->id;
    //         $user->password = sha1($request->password);
    //         if($request->password == $request->confirm_password)
    //         {
    //             $user->save();
    
    //             return redirect('/login');
    //         }
    //         else
    //         {
    //             return "error";
                
    //         }
    //     }
    // }
    
    public function register(Request $request)
    {
        //request krna hai name email or password user se aayega user se
        $register_user = Contact_Item::where('value','=',$request->email)->first();
        if(!$register_user)
        {
            $register_contact = new Contact();
            $register_contact->name = $request->name;
            $register_contact->save();

            $register_contact_item_type = new contact_Item();
            $register_contact_item_type->belongs_to = $register_contact->id;
            $register_contact_item_type->value = $request->email;
            // $register_contact_item_type->verified_on = $request->verified_on;
            $register_contact_item_type->status = 'off';
            $register_contact_item_type->created_by = $register_contact->id;
            $register_contact_item_type->verification_status = 'not_verified';

            //  making variable verification_status  is equal to variable email_verification_status
            // $email_verification_status = $register_contact_item_type->verification_status;
            // $this->email_verification($email_verification_status);
            
            // making variable verification_code is equal to variable Quantity
            // $check_verification_code = $register_contact_item_type->verification_code;
            // $this->email_verification($check_verification_code);

            $register_contact_item_type->save();
            // $this->email('register_contact_item_type->verification_code',$register_contact_item_type->verification_code);
            //verification email has to sent to verify
            \Mail::to($request->email)->send(new accountVEmail());
            

            $register_user = new User();
            $register_user->contact_id = $register_contact->id;
            $register_user->password = sha1($request->password);
            if($request->password == $request->confirm_password)
            {
                $register_user->save();

                return redirect('/login');
            }
            else
            {
                return 'please check all the detail were entered correctly';
            }
            return 'we have Created your account';
        }

        else
        {
            if($register_user->verification_status == 'verified')
            {
                return 'Email Already Exists';
            }
            else
            {
                $register_new_user = new Contact();
                $register_new_user->name = $request->name;
                $register_new_user->save();

                $register_user->created_by = $register_new_user->id;
                $register_user->status = 'off';
                $register_user->belongs_to = $register_new_user->id;
                $register_user->save();

                //verification email to be sent

                $register_again_new = new User();
                $register_again_new->contact_id = $register_user->id;
                $register_again_new->password = sha1($request->password);
                if($request->password == $request->confirm_password)
                {
                    $register_user->save();
    
                    return redirect('/welcome');
                }
                else
                {
                    return 'please check all the detail were entered correctly';
                }
                return 'we have sent an verification email please verify user your email';
            }

        }
    }

    public function login(Request $request)
    {
        $login_user = Contact_Item::where('value', '=', $request->email)->first();

        if(!$login_user)
        {
            return 'User Not Found';
        }
        else
        {
            if($login_user->verification_status != 'verified')
            {
                return 'Account Not Verified Please Verify Your Account to Login';
            }
            else
            {
                $user = User::where('contact_id', $login_user->belongs_to)->first();
                if($user->password == sha1($request->password))
                {
                    Auth::login($user);
                    return redirect('/navbar');
                }
                else
                {
                    return 'Invalid Credentials';
                }
            }
        }
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        return redirect('/login');
    }
    
    // public function email_verification($quantity)
    // {       
        
        // $register_contact_item_type->verification_code = $this('register')-Value;
        // $register_contact_item_type->verification_code = $id;
        // $email_verification = Contact_Item::where('verification_code', '=',$quantity)->first();
        
        // if(!$email_verification)
        // {
        //     return "Please try Again";
        // }
        // else
        // {
        //     if($email_verification == $quantity)
        //     {
        //         return($verification_status == 'verified');
        //     }
        //     else
        //     {
        //         return "not verified";
        //     }
        // }
    // }

    public function email_verification(Request $request)
    {
        $verification_code = $request->verification_code;
        $contact_item_exist = Contact_Item::where('verification_code','LIKE',$verification_code)->first();
        if($contact_item_exist)
        {
            
            $contact_item_exist->verification_status = 'verified';
            $contact_item_exist->save();
            return redirect('verified');
        }
        else
        {
            return 'invalid verification code';
        }
    }

    public function show()
    {
        $user_id = Auth::user()->id;
        return $user_id;
    }
    
    public function upate_profile($id)
    {

        return $request->input();
    }

}
