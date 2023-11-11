<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    private function checkSession(){
        if(session()->missing('user_id')){
            return redirect('/');
        }
    }

    public function index()
    {
        $genders = [
            'Male',
            'Female',
        ];

        if ($this->checkSession()) {
            return $this->checkSession();
        }

        // Retrieve the user data
        $user = Users::find(session('user_id'));

        return view('student.profile', ['user' => $user], compact('genders'));
    }


    public function update(Request $request, Users $user)
    {
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
            'learner_reference_number' => 'nullable|string|size:12',
            'graduation_year' => 'nullable|string',
            'last_grade_attended' => 'nullable|string',
            'adviser_name' => 'nullable|string',
            'adviser_section' => 'nullable|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->user_id, 'user_id'),
            ],
            'password' => 'nullable|min:8|confirmed',
            'guardian_full_name' => 'required|string',
            'guardian_contact_number' => 'required|string|size:11',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        

        $attribNames = [
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'date_of_birth' => 'Date of Birth',
            'gender' => 'Gender',
            'contact_number' => 'Contact Number',
            'complete_address' => 'Complete Address',
            'grade_level' => 'Grade Level',
            'section' => 'Section',
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
        ];

        $this->validate($request, $rules, [], $attribNames);

        // Update the user's information
        Users::where('user_id', $user->user_id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'complete_address' => $request->complete_address,
            'grade_level' => $request->grade_level,
            'section' => $request->section,
            'learner_reference_number' => $request->learner_reference_number,
            'graduation_year' => $request->graduation_year,
            'last_grade_attended' => $request->last_grade_attended,
            'adviser_name' => $request->adviser_name,
            'adviser_section' => $request->adviser_section,
            'email' => $request->email,
            'guardian_full_name' => $request->guardian_full_name,
            'guardian_contact_number' => $request->guardian_contact_number,
            'profile_picture' => $request->profile_picture,
        ]);

        return redirect()->route('student.profile')->with('profile-updated', 'Profile updated successfully!');
    }
}
