@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Document Request</h2>
        <form method="post" action="{{ route('document-request.update', ['documentRequest' => $documentRequest]) }}">

            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="document_id">Document Type</label>
                    <select class="form-control" name="document_id" id="document_id">
                        @foreach($documents as $document)
                            <option value="{{ $document->document_id }}" {{ $documentRequest->document_id == $document->document_id ? 'selected' : '' }}>
                                {{ $document->document_type }}
                            </option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="form-group col-md-6">
                    <label for="number_of_copies">Number of Copies</label>
                    <input class="form-control" type="number" name="number_of_copies" id="number_of_copies" value="{{ $documentRequest->number_of_copies }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="purpose">Purpose of Request</label>
                    <select class="form-control" name="purpose" id="purpose">
                        <option value="" disabled>Select Purpose</option>
                        @foreach ($purposes as $category => $purposeList)
                            <optgroup label="{{ $category }}">
                                @foreach ($purposeList as $purpose)
                                    <option value="{{ $purpose }}" {{ $documentRequest->purpose == $purpose ? 'selected' : '' }}>
                                        {{ $purpose }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    
                </div>
                
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
