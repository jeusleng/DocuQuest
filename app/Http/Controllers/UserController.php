<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function Login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $attribNames = array(
            'email' => 'Email',
            'password' => 'Password',
        );

        $this->validate($request, $rules, [], $attribNames);

        $userCredentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $authenticated = Auth::guard('users')->attempt($userCredentials);

        if ($authenticated) {
            $user = Auth::guard('users')->user();

            if ($user->act_status === 'Active') {
                session([
                    'user_id' => $user->user_id,
                    'type' => $user->type,
                    'email' => $user->email,
                    'first_name' => $user->first_name,
                    'middle_name' => $user->middle_name,
                    'last_name' => $user->last_name,
                    'date_of_birth' => $user->date_of_birth,
                    'gender' => $user->gender,
                    'act_status' => $user->act_status,
                    'student_type' => $user->student_type,
                    'contact_number' => $user->contact_number,
                    'complete_address' => $user->complete_address,
                    'grade_level' => $user->grade_level,
                    'section' => $user->section,
                    'learner_reference_number' => $user->learner_reference_number,
                    'graduation_year' => $user->graduation_year,
                    'last_grade_attended' => $user->last_grade_attended,
                    'adviser_name' => $user->adviser_name,
                    'adviser_section' => $user->adviser_section,
                    'guardian_full_name' => $user->guardian_full_name,
                    'guardian_contact_number' => $user->guardian_contact_number,
                ]);

                if ($user->type === 'student') {
                    return redirect('/home');
                } elseif ($user->type === 'admin') {
                    return redirect()->route('admin.dashboard');
                }
            } else {
                Auth::guard('users')->logout();
                session(['act-status-inactive' => true]);
                return redirect('/');
            }
        }

        session()->flash('invalid-login');
        return redirect('/');
    }


    public function Register(Request $request){
        $rules = [
        'first_name' => 'required|string',
        'middle_name' => 'nullable|string',
        'last_name' => 'required|string',
        'date_of_birth' => 'required|date',
        'gender' => 'required|string',
        'contact_number' => 'required|string|size:11',
        'complete_address' => 'required|string',
        'grade_level' => 'nullable|string',
        'section' => 'nullable|string',
        'student_type' => 'required|string',
        'act_status' => 'required|string',
        'learner_reference_number' => 'nullable|string|size:12',
        'graduation_year' => 'nullable|string',
        'last_grade_attended' => 'nullable|string',
        'adviser_name' => 'nullable|string',
        'adviser_section' => 'nullable|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'guardian_full_name' => 'required|string',
        'guardian_contact_number' => 'required|string|size:11',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $attribNames = array(
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'date_of_birth' => 'Date of Birth',
            'gender' => 'Gender',
            'contact_number' => 'Contact Number',
            'complete_address' => 'Complete Address',
            'grade_level' => 'Grade Level',
            'act_status' => 'Account Status',
            'section' => 'Section',
            'student_type' => 'Student Type',
            'learner_reference_number' => 'LRN',
            'graduation_year' => 'Graduation Year',
            'last_grade_attended' => 'Last Grade Attended',
            'adviser_name' => 'Adviser Name',
            'adviser_section' => 'Alumni Section',
            'email' => 'Email',
            'password' => 'Password',
            'guardian_full_name' => 'Guardian Full Name',
            'guardian_contact_number' => 'Guardian Contact Number',
            'profile_picture' => 'Profile Picture',
        );

        $this->validate($request, $rules, [], $attribNames);

        $existingUser = Users::where('email', '=', $request->email)->first();

        if ($existingUser) {

            session()->flash('email-exist');

            return back();
        }

        $users = new Users();
        $users->type = 'student';
        $users->email = $request->email;
        $users->first_name = $request->first_name;
        $users->middle_name = $request->middle_name;
        $users->last_name = $request->last_name;
        $users->date_of_birth = $request->date_of_birth;
        $users->act_status = $request->act_status;
        $users->gender = $request->gender;
        $users->contact_number = $request->contact_number;
        $users->complete_address = $request->complete_address;
        $users->grade_level = $request->grade_level;
        $users->section = $request->section;
        $users->learner_reference_number = $request->learner_reference_number;
        $users->graduation_year = $request->graduation_year;
        $users->last_grade_attended = $request->last_grade_attended;
        $users->adviser_name = $request->adviser_name;
        $users->student_type = $request->student_type;
        $users->adviser_section = $request->adviser_section;
        $users->guardian_full_name = $request->guardian_full_name;
        $users->guardian_contact_number = $request->guardian_contact_number;
        $users->profile_picture = $request->profile_picture;
        $users->password = bcrypt($request->password);
        $users->save();

        session()->flash('register-success');

        return redirect('/');
    }

    public function logout(){
        session()->forget('user_id');
        session()->forget('email');
        session()->forget('first_name');
        session()->forget('middle_name');
        session()->forget('last_name');
        session()->forget('date_of_birth');
        session()->forget('gender');
        session()->forget('contact_number');
        session()->forget('complete_address');
        session()->forget('grade_level');
        session()->forget('section');
        session()->forget('student_type');
        session()->forget('act_status');
        session()->forget('learner_reference_number');
        session()->forget('graduation_year');
        session()->forget('last_grade_attended');
        session()->forget('adviser_name');
        session()->forget('adviser_section');
        session()->forget('guardian_full_name');
        session()->forget('guardian_contact_number');
    
        session()->flush();
    
        return redirect('/');
    }

    private function checkSession(){
        if(session()->has('user_id')){
            if(session('type') == 'student'){
                return redirect('/home');
            }
            else{
                return redirect('admin.dashboard');
            }
        }
    }

    public function goLogin(){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        return view('login');
    }

    public function goRegistration(){
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        return view('registration');
    }

    public function generateAdmin(){

        $adminExists = Users::where('email', 'sfhs-admin@gmail.com')->exists();

        if (!$adminExists) {
            $users = new Users();
            $users->type = 'admin';
            $users->email = 'sfhs-admin@gmail.com';
            $users->first_name = '';
            $users->middle_name = '';
            $users->last_name = '';
            $users->date_of_birth = '2002-10-10';
            $users->gender = '';
            $users->complete_address = '';
            $users->grade_level = '';
            $users->section = '';
            $users->act_status = 'Active';
            $users->learner_reference_number = '';
            $users->graduation_year = '';
            $users->student_type = '';
            $users->last_grade_attended = '';
            $users->adviser_name = '';
            $users->guardian_full_name = '';
            $users->guardian_contact_number = '';
            $users->profile_picture = '';
            $users->password = bcrypt('.2e1(]XTXB3~');
            $users->save();
        }

        return redirect('/');
    }
}
