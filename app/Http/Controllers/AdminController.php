<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequests;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private function checkSession()
    {
        if (session()->missing('user_id')) {
            return redirect('/');
        }
    }

    public function index()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        // Redirect to login if not authenticated
        if (!auth()->check()) {
            return redirect('/');
        }

        return view('admin.dashboard');
    }

    public function showDashboard()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }
        // Get total number of users, approved requests, and pending requests
        $totalStudents = Users::where('type', 'student')->count();
        $totalApprovedRequests = DocumentRequests::where('request_status', 'approved')->count();
        $totalPendingRequests = DocumentRequests::where('request_status', 'pending')->count();
        $totalCompletedRequests = DocumentRequests::where('request_status', 'completed')->count();
        
        // Get the most requested document types and their counts
        $documentTypesData = DocumentRequests::join('documents', 'document_requests.document_id', '=', 'documents.document_id')
            ->select('documents.document_type', DB::raw('COUNT(*) as count'))
            ->groupBy('documents.document_type')
            ->orderByDesc('count')
            ->limit(5) // Adjust the limit as needed
            ->get();

        // Extract data for the chart
        $documentTypes = $documentTypesData->pluck('document_type');
        $documentCounts = $documentTypesData->pluck('count');

        $colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'];

        return view('admin.dashboard', compact('totalStudents', 'totalCompletedRequests', 'totalApprovedRequests', 'totalPendingRequests', 'documentTypes', 'documentCounts', 'colors'));
    }

    public function showPending()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        // Fetch pending document requests
        $pendingRequests = DocumentRequests::where('request_status', 'pending')->get();

        return view('admin.pending', compact('pendingRequests'));
    }

    public function editPending($id)
    {
        // Fetch the necessary data for the view
        $documentRequest = DocumentRequests::findOrFail($id);
        $student = Users::findOrFail($documentRequest->user_id); // Assuming user_id is the foreign key for students

        return view('admin.edit-pending', compact('documentRequest', 'student'));
    }

    public function updatePending(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'request_status' => 'required|in:Pending,Approved,Declined',
            'appointment_date_time' => 'nullable|date_format:Y-m-d\TH:i',
            'reason_declined' => 'nullable',
        ]);

        // Find the DocumentRequest by ID
        $documentRequest = DocumentRequests::findOrFail($id);

        // Convert the input datetime to a Carbon instance for proper handling
        $appointmentDateTime = $request->input('appointment_date_time')
            ? Carbon::parse($request->input('appointment_date_time'))
            : null;

        // Update the fields
        $documentRequest->update([
            'request_status' => $request->input('request_status'),
            'appointment_date_time' => $appointmentDateTime,
            'reason_declined' => $request->input('reason_declined'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Document request updated successfully!');
    }

    public function showApproved()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        // Fetch approved document requests
        $approvedRequests = DocumentRequests::where('request_status', 'Approved')->get();

        return view('admin.approved', compact('approvedRequests'));
    }

    public function showDeclined()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        // Fetch declined document requests
        $declinedRequests = DocumentRequests::where('request_status', 'Declined')->get();

        return view('admin.declined', compact('declinedRequests'));
    }

    public function showUpcoming()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $upcomingAppointments = DocumentRequests::where('request_status', 'Approved')->get();

        return view('admin.upcoming', compact('upcomingAppointments'));
    }

    public function showCompleted()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $completedAppointments = DocumentRequests::where('request_status', 'Completed')->get();

        return view('admin.completed', compact('completedAppointments'));
    }

    public function showCompletedReqs()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $completedRequests = DocumentRequests::where('request_status', 'Completed')->get();

        return view('admin.completed-reqs', compact('completedRequests'));
    }

    public function displayUsers(Request $request)
    {
        // Retrieve all users with type = "student" and student_type = "current"
        $students = Users::where('type', 'student')->where('student_type', 'current')->get();

        // Pass the $students variable to a view
        return view('admin.display-users', ['students' => $students]);
    }

    public function displayAlumni(Request $request)
    {
        $students = Users::where('type', 'student')->where('student_type', 'alumni')->get();

        // Pass the $students variable to a view
        return view('admin.display-alumni', ['students' => $students]);
    }

    public function viewUser($userId)
    {
        // Retrieve the user information based on the provided $userId
        $user = Users::findOrFail($userId);

        // Pass the user data to the view
        return view('admin.view-user', ['user' => $user]);
    }

    public function updateStatus(Request $request, $userId)
    {
        // Validate the form data
        $request->validate([
            'act_status' => 'required|in:Active,Inactive',
        ]);

        // Find the user by ID
        $user = Users::findOrFail($userId);

        // Update the status
        $user->update(['act_status' => $request->input('act_status')]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User status updated successfully!');
    }


}
