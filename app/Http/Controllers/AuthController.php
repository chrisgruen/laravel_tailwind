<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\Company;
use App\Mail\PasswordResetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;
use Redirect;
use Helper;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{

    use AuthenticatesUsers;

    public function getSignup()
    {
        $user = new User();
        return view('auth.register', ['customerTypes' => $user->customerTypes, 'user' => $user]);
    }

    public function postSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:6|same:password_confirm',
            'lastname' => 'required',
            'firstname' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
            'address' => 'required',
            'customerType' => 'required',
        ]);

        $user = new User([
            'email' => $request->input('email'),
            'firstname' => trim(ucfirst($request->input('firstname'))),
            'lastname' => trim(ucfirst($request->input('lastname'))),
            'password' => bcrypt($request->input('password')),
            'zipcode' => $request->input('zipcode'),
            'city' => trim(ucfirst($request->input('city'))),
            'address' => trim(ucfirst($request->input('address'))),
            'company' => trim(ucfirst($request->input('company'))),
            'phonenumber' => $request->input('phonenumber'),
            'mobilenumber' => $request->input('mobilenumber'),
            'customerType' => $request->input('customerType'),
            'authKeyPost' => str_random(8),
            'authKeyMail' => str_random(8),
            'settings' => json_encode(array('boardValue' => 100000)),
            'registrationState' => 'new',
        ]);

        $user->save();
        Auth::logout();
        Auth::guard('account')->logout();
        Auth::guard('web')->logout();
        Session::flush();
        Auth::login($user);
        return redirect()->route('user.status');
    }

    public function getSignin()
    {
        return view('auth.login', array('attempt' => false));
    }

    public function postSignin(Request $request)
    {

        $isUser = User::where('email', $request->email)->first();

        if ($isUser) {
            $this->validate($request, [
                'email' => 'email|required|exists:users,email,isBlocked,0',
                'password' => 'required|min:5'],
                [
                    'email.exists' => trans('auth.blocked'),
                ]
            );
        } else {
            $this->validate($request, [
                'email' => 'email|required',
                'password' => 'required|min:5']
            );
        }

        if (Auth::guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'isBlocked' => 0])) {

            return redirect()->intended(route('index'));

        } elseif (Auth::guard('account')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if(request()->is('login')) {
                $com_id = Auth::guard('account')->user()->company_id;
                $subName = Company::where('id', $com_id)->value('subdomain');
                $subUrl = Helper::buildSubUrl($subName);
                return Redirect::to($subUrl);
            } else {
                return redirect()->intended(route('index'));
            }
        }
        
        return $this->sendFailedLoginResponse($request);
    }

    public function getLogout()
    {
     //  dd('logging out');
        Auth::logout();
        Auth::guard('account')->logout();
        Auth::guard('web')->logout();
        Session::flush();
        return redirect()->route('index');
    }

    public function passwordResetForm(Request $request)
    {
        return view('auth.passwords.email');
    }

    public function passwordReset(Request $request)
    {
        /* Validation */
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        if ($user !== Null) {
            //update Password (user)
            $new_password = str_random(8);
            $user->password = bcrypt($new_password);
            $user->save();
            Mail::to($user->email, $user->firstname . ' ' . $user->lastname)->send(new PasswordResetMail($user, $new_password));
        } else {
            $account = Account::where('email', '=', $request->email)->first();
            if($account !== Null) {
                //update Password (account)
                $new_password = str_random(8);
                $account->password = bcrypt($new_password);
                $account->save();
                Mail::to($account->email, $account->firstname . ' ' . $account->lastname)->send(new PasswordResetMail($account, $new_password));
            } else {
                $this->validate($request, [
                    'email' => 'exists:users|exists:accounts',
                ]);
            }
        }
        return redirect()->back()->with('status', trans('passwords.sent'));
    }
}
