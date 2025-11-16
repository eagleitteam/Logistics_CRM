<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use App\Models\Yearmaster;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLogin()
    {
        $quotes = [];
        for ($i = 1; $i <= 3; $i++) {
            array_push($quotes, Inspiring::quote());
        }

        $yearmasters = Yearmaster::latest()->get();

        // dd($yearmasters);

        return view('admin.auth.login')->with(['quotes' => $quotes,'yearmasters' => $yearmasters,]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username'          => 'required',
                'password'          => 'required',
                'yearmaster_id'  => 'required|exists:yearmasters,id',
            ],
            [
                'username.required'         => 'Please Enter Username',
                'password.required'         => 'Please Enter Password',
                'yearmaster_id.required'  => 'Please Select Financial Year',
            ]
        );

        if ($validator->passes()) {
            $username = $request->username;
            $password = $request->password;
            $remember_me = $request->has('remember_me') ? true : false;


            try {
                $user = User::where('mobile', $username)->first();

                if (!$user)
                    return response()->json(['error2' => 'No user found with this username']);

                if ($user->active_status == '0' && !$user->roles)
                    return response()->json(['error2' => 'You are not authorized to login, contact HOD']);

                if (!auth()->attempt(['mobile' => $username, 'password' => $password], $remember_me))
                    return response()->json(['error2' => 'Your entered credentials are invalid']);

                // ✅ Store active year in session for middleware access
                $activeYear = Yearmaster::find($request->yearmaster_id);

                if ($activeYear) {
                    session(['active_year_id' => $activeYear->id, 'financial_year_title' => $activeYear->title,'status' => $activeYear->status,'freeze_status' => $activeYear->freeze_status]);

                    // Log::info('Active Yearmaster ID: ' . $activeYear->id, ['financial_year_title' => $activeYear->title, 'status' => $activeYear->status, 'freeze_status' => $activeYear->freeze_status]);

                }else {
                    session(['financial_year_title' => 'N/A']);
                }

                $userType = '';
                if ($user->hasRole(['User']))
                    $userType = 'user';

                if ($user->hasRole(['Employee']))
                    $userType = 'employee';

                // Log::info('Active Yearmaster ID: ' . session('active_yearmaster_id'));

                return response()->json(['success' => 'login successful', 'user_type' => $userType, 'user'=> $user, 'yearmaster_id' => $request->yearmaster_id]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::info("login error:" . $e);
                return response()->json(['error2' => 'Something went wrong while validating your credentials!']);
            }
        } else {
            return response()->json(['error' => $validator->errors()]);
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate(); // destroy all session data
        $request->session()->regenerateToken(); // regenerate CSRF token

        return redirect()->route('login');
    }


    public function showChangePassword()
    {
        return view('admin.auth.change-password');
    }


    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
            'confirm_password' => 'required|same:password',
        ], [
            'password.regex' => 'The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        if ($validator->passes()) {
            $old_password = $request->old_password;
            $password = $request->password;

            try {
                $user = DB::table('users')->where('id', $request->user()->id)->first();

                if (Hash::check($old_password, $user->password)) {
                    DB::table('users')->where('id', $request->user()->id)->update([
                                                                            'password'      => Hash::make($password),
                                                                            'updated_by'    => Auth::user()->id,
                                                                            'updated_at'    => now(),

                                                                            ]);


                    $userType = '';
                    if (Auth::user()->hasRole(['User']))
                        $userType = 'user';

                    if (Auth::user()->hasRole(['Employee']))
                        $userType = 'employee';

                    return response()->json(['success' => 'Password changed successfully!', 'user_type' => $userType]);
                } else {
                    return response()->json(['error2' => 'Old password does not match']);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                Log::info("password change error:" . $e);
                return response()->json(['error2' => 'Something went wrong while changing your password!']);
            }
        } else {
            return response()->json(['error' => $validator->errors()]);
        }
    }
}
