@extends('layouts/contentNavbarLayout')

@section('title', 'Biometrics Extract')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
@endsection

@section('content')
<h5 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Attendance / Biometrics Extract /</span> Upload File
</h5>

<!-- Responsive Table -->
<div class="card">
    <form method="POST" class="dropzone needsclick" id="dropzone-basic">
        @csrf
        <div class="dz-message needsclick">
            Drop files here or click to upload
        </div>
        <div class="fallback">
            <input name="file" type="file" accept="text/plain"/>
        </div>
        
        <!-- <button type="submit" class="btn btn-primary float-end">Submit</button> -->
    </form>
</div>
<!--/ Responsive Table -->
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
@endsection

@section('page-script')
<script>
    var previewTemplate = `
        <div class="dz-preview dz-file-preview">
            <div class="dz-details">
                <div class="dz-thumbnail">
                    <img data-dz-thumbnail>
                    <div class="dz-success-mark" 
                         style="background-color: rgba(0,0,0,0) !important; background-image: url('') !important;">
                         <span class="badge badge-center rounded-pill bg-primary" style="padding:3em;">
                            <i class="bx bxs-file-txt bx-lg"></i>
                         </span>
                    </div>
                    <div class="dz-error-mark">
                    </div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                    </div>
                </div>
                <div><strong class="dz-filename text-center" data-dz-name></strong></div>
                <div class="dz-size text-center" data-dz-size></div>
            </div>
        </div>
    `;

    const myDropzone = new Dropzone('#dropzone-basic', {
        previewTemplate: previewTemplate,
        parallelUploads: 1,
        maxFilesize: 5,
        addRemoveLinks: true,
        maxFiles: 1,
        acceptedFiles: ".txt",
        url: "/asdasd",
        init: function() {
            this.on("success", function(file, response) {
                console.log(response);
            });
        }
    });
</script>
@endsection