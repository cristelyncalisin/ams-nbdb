@extends('layouts/contentNavbarLayout')

@section('title', 'Biometrics Extract')

@section('vendor-style')
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endsection

@section('content')
<h5 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Attendance / Biometrics Extract /</span> Upload Biometrics File (.txt)
</h5>

@if(session('error'))
    <div>
        <div class="alert alert-dark d-flex mb-3" role="alert">
            <span class="badge badge-center rounded-pill bg-dark border-label-dark p-3 me-2"><i class="bx bx-error-alt fs-6"></i></span>
            <div class="d-flex flex-column ps-1">
                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Error!!</h6>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('attendance-biometrics-store') }}">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <input class="form-control" type="file" name="file" class="filepond">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </div>
                </div>
            </div>
            <!-- <div class="dz-message needsclick">
                Drop files here or click to upload
            </div>
            <div class="fallback">
                <input name="file" type="file" accept="text/plain"/>
            </div> -->

        </form>
    </div>
</div>
<!--/ Responsive Table -->
@endsection

@section('vendor-script')
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
@endsection

@section('page-script')
<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Register the plugin
    FilePond.registerPlugin(FilePondPluginFileValidateType);

    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
        acceptedFileTypes: ['text/plain']
    });

    FilePond.setOptions({
        server: {
            url: "{{ route('attendance-biometrics-upload') }}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    })
</script>
@endsection