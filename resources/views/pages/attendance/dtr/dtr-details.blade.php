
@if (!empty($dtr_details))
<small class="text-light fw-semibold">Employee List with Attendance Details</small>
@endif

<div id="dtrAccordion" class="accordion accordion-popout mt-3">
    @include('pages.attendance.dtr.dtr-subdetails')
</div>