<div class="accordion-item card active">
    <h2 class="accordion-header text-body d-flex justify-content-between" id="dtrAccordionOne">
        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#dtrAccordion-1" aria-controls="dtrAccordion-1">
            <i class="bx bx-user me-2"></i>
            Accordion Item 1
        </button>
    </h2>

    <div id="dtrAccordion-1" class="accordion-collapse collapse show" data-bs-parent="#dtrAccordion">
        <div class="accordion-body">
            <div class="table-responsive text-nowrap" style="min-height: 500px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="fw-bolder">#</th>
                            <th class="fw-bolder">Date Entry</th>
                            <th class="fw-bolder">Time In</th>
                            <th class="fw-bolder">Time Out</th>
                            <th class="fw-bolder">Source</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($time_entries as $time_entry)
                        @php
                        $iteration = ($loop->first) ? $loop->iteration + (($time_entries->currentPage() - 1) * $time_entries->perPage()) : $iteration + 1;
                        @endphp
                        <tr>
                            <th scope="row">{{ $iteration }}</th>
                            <td>{{ \Carbon\Carbon::parse($time_entry->date_entry)->format('M. d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($time_entry->time_in)->format('h:i A') }}</td>
                            <td>{{ $time_entry->time_out ? \Carbon\Carbon::parse($time_entry->time_out)->format('h:i A') : '-' }}</td>
                            <td>
                                <span class="text-truncate d-flex align-items-center" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title="<span>Source: {{$time_entry->source}}</span>">
                                    <span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">
                                        @if($time_entry->source == 'Google Forms')
                                        <i class="bx bxl-google bx-xs"></i>
                                        @else
                                        <i class="bx bxs-watch bx-xs"></i>
                                        @endif
                                    </span>
                                </span>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No Records Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mx-3 mt-4">
                <div class="d-flex float-end">
                    @if(count($time_entries))
                    {{ $time_entries->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>