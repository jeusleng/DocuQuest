<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequests;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private function checkSession(){
        if(session()->missing('user_id')){
            return redirect('/');
        }
    }

    public function index()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
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

        return view('admin.dashboard', compact('totalStudents', 'totalApprovedRequests', 'totalPendingRequests', 'documentTypes', 'documentCounts', 'colors'));
    }

    public function showPending()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }
        
        return view('admin.pending');
    }
}
