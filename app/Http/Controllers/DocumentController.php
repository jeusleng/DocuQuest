<?php

namespace App\Http\Controllers;
use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function insertDocuments()
    {
        $documents = [
            [
                'document_type' => 'Certificate of Good Moral Character',
                'requirements' => 'Purpose of request, learner\'s picture of ID card, number of requested copies',
            ],
            [
                'document_type' => 'SF-10 (formerly known as Form-137)',
                'requirements' => 'Purpose of request, learner\'s picture of ID card, number of requested copies',
            ],
            [
                'document_type' => 'Report Card',
                'requirements' => 'Purpose of request, learner\'s picture of ID card (if current student, if alumni, any government valid ID), number of requested copies',
            ],
            [
                'document_type' => 'Diploma',
                'requirements' => 'Purpose of request, learner\'s picture of ID card (if current student, if alumni, any government valid ID), number of requested copies',
            ],
            [
                'document_type' => 'Letter of Recommendation',
                'requirements' => 'Purpose of request, learner\'s picture of ID card (if current student, if alumni, any government valid ID), number of requested copies',
            ],
            [
                'document_type' => 'Proof of Enrollment',
                'requirements' => 'Purpose of request, learner\'s picture of ID card (if current student, if alumni, any government valid ID), number of requested copies',
            ],
            [
                'document_type' => 'Special Certification',
                'requirements' => 'Purpose of request, enter the specific certification needed, learner\'s picture of ID card (if current student, if alumni, any government valid ID), number of requested copies',
            ],
        ];

        foreach ($documents as $document) {
            // Check if the document already exists before creating a new one
            $existingDocument = Documents::where('document_type', $document['document_type'])->first();

            if (!$existingDocument) {
                Documents::create($document);
            }
        }

        return redirect('/');
        
    }

}
