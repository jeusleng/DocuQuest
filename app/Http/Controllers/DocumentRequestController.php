<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Models\DocumentRequests;
use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use App\Models\Documents;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;


class DocumentRequestController extends Controller
{
    public $timestamps = false;

    private function checkSession(){
        if(session()->missing('user_id')){
            return redirect('/');
        }
    }

    // Show the document request form
    public function showRequestForm()
    {
        if ($this->checkSession()) {
            return $this->checkSession();
        }

        $documents = Documents::all(); // Retrieve document types from the database

        $purposes = [
            'Academic Records' => [
                'Scholarship Application',
                'College/University Admission',
                'Enrollment in a New School',
                'Transfer of School or University',
                'Submission of Grades to Parents or Guardians',
                'Internship or On-the-Job Training (OJT) Requirement',
                'Graduation Requirements',
                'Validation of Academic Credentials',
            ],
            'Government or Legal Requirements' => [
                'Passport Application',
                'Driver\'s License Application',
                'National ID Application',
                'Social Security System (SSS) Application',
                'Government Employment Application',
                'Legal Proceedings or Affidavits',
                'Visa Application',
            ],
            'Personal Use or Records' => [
                'Personal Record Keeping',
                'Bank Loan or Financial Transactions',
                'Housing Loan Application',
                'Travel Abroad (e.g., for visa requirements)',
                'Adoption Process',
                'Insurance Claims',
                'Business Transactions (e.g., business permits)',
                'Migration or Emigration Documentation',
            ],
            'Other Special Requests' => [
                'Disability Claims or Benefits',
                'Sports or Athletic Scholarships',
                'Grants or Financial Aid',
                'Exchange Programs',
                'Professional Development (e.g., teaching or medical certification)',
                'Research or Thesis Documentation',
                'Reimbursement of Education Expenses',
            ],
        ];
        
        return view('student.document-request', compact('documents', 'purposes'));
    }

    public function storeRequest(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer',
        'document_id' => 'required|integer',
        'number_of_copies' => 'required|integer',
        'purpose' => 'required|string',
        'id_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate and restrict file types
    ]);

    // Handle the uploaded image file
    if ($request->hasFile('id_picture')) {
        $file = $request->file('id_picture');
        $path = $file->store('id_pictures'); // Store the file in the 'id_pictures' directory
    } else {
        $path = null; // No file was uploaded
    }

    // Create a new document request using the value from the hidden input
    $requestData = [
        'user_id' => $request->user_id,
        'document_id' => $request->document_id,
        'number_of_copies' => $request->number_of_copies,
        'purpose' => $request->purpose,
        'id_picture' => $path, // Store the file path in the database
        'created_at' => $request->input('created_at'), // Use the value from the hidden input
    ];

    DocumentRequests::create($requestData);

    return redirect()->route('document-request.history')->with('success', 'Document request submitted successfully');
}



    public function showRequestHistory(Request $request)
    {
        // Retrieve the request history for the current user with the 'document' relationship eager loaded
        $user_id = session('user_id');
        $documentRequests = DocumentRequests::with('documents')->where('user_id', $user_id)->get();

        return view('student.request-history', compact('documentRequests'));
    }

    public function cancelRequest(DocumentRequests $documentRequest)
    {
        $documentRequest->delete();

        return redirect()->back()->with('success', 'Request canceled successfully');
    }

    public function edit(DocumentRequests $documentRequest)
    {
        $documents = Documents::all(); // Retrieve document types from the database

        $purposes = [
            'Academic Records' => [
                'Scholarship Application',
                'College/University Admission',
                'Enrollment in a New School',
                'Transfer of School or University',
                'Submission of Grades to Parents or Guardians',
                'Internship or On-the-Job Training (OJT) Requirement',
                'Graduation Requirements',
                'Validation of Academic Credentials',
            ],
            'Government or Legal Requirements' => [
                'Passport Application',
                'Driver\'s License Application',
                'National ID Application',
                'Social Security System (SSS) Application',
                'Government Employment Application',
                'Legal Proceedings or Affidavits',
                'Visa Application',
            ],
            'Personal Use or Records' => [
                'Personal Record Keeping',
                'Bank Loan or Financial Transactions',
                'Housing Loan Application',
                'Travel Abroad (e.g., for visa requirements)',
                'Adoption Process',
                'Insurance Claims',
                'Business Transactions (e.g., business permits)',
                'Migration or Emigration Documentation',
            ],
            'Other Special Requests' => [
                'Disability Claims or Benefits',
                'Sports or Athletic Scholarships',
                'Grants or Financial Aid',
                'Exchange Programs',
                'Professional Development (e.g., teaching or medical certification)',
                'Research or Thesis Documentation',
                'Reimbursement of Education Expenses',
            ],
        ];

        return view('student.edit-document-request', compact('documentRequest', 'documents', 'purposes'));
    }

    public function update(Request $request, DocumentRequests $documentRequest)
    {
        $request->validate([
            'document_id' => 'required', // Make sure this matches the column name
            'number_of_copies' => 'required|integer',
            'purpose' => 'required',
        ]);

        $documentRequest->update([
            'document_id' => $request->document_id,
            'number_of_copies' => $request->number_of_copies,
            'purpose' => $request->purpose,
        ]);

        return redirect()->route('document-request.history')->with('success', 'Document request updated successfully');
    }

    public function uploadReceipt(Request $request, DocumentRequests $documentRequest)
{
    // Validate the uploaded file
    $request->validate([
        'acknowledgment_receipt' => 'required|mimes:pdf,jpg,png|max:2048',
    ]);

    // Check if the document request already has an acknowledgment receipt
    if ($documentRequest->acknowledgment_receipt) {
        // Delete the existing acknowledgment receipt file
        Storage::delete($documentRequest->acknowledgment_receipt);
    }

    // Store the newly uploaded acknowledgment receipt
    $acknowledgmentReceipt = $request->file('acknowledgment_receipt');
    $receiptPath = $acknowledgmentReceipt->store('acknowledgment_receipts', 'public');

    // Update the document request with the new receipt path and set the status to "Completed"
    $documentRequest->update([
        'acknowledgment_receipt' => $receiptPath,
        'request_status' => 'Completed',
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Acknowledgment receipt uploaded successfully!');
}

public function viewAcknowledgmentReceipt(DocumentRequests $documentRequest)
{
    return response($documentRequest->acknowledgment_receipt)
        ->header('Content-Type', 'pdf,jpg,png'); // Adjust the Content-Type based on your actual image type
}


}
