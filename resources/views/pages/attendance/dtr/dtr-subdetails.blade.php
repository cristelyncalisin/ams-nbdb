@foreach ($dtr_details as $dtr)
    <div class="accordion-item card @if($loop->iteration == 1) active @endif">
        <h2 class="accordion-header text-body d-flex justify-content-between" id="dtrAccordionOne">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#employee-{{ $dtr['employee_id'] }}" aria-controls="employee-{{ $dtr['employee_id'] }}">
                <i class="bx bx-user me-2"></i>
                {{ $dtr['last_name'] }}, {{ $dtr['first_name'] }}
            </button>
        </h2>

        <div id="employee-{{ $dtr['employee_id'] }}" class="accordion-collapse collapse @if($loop->iteration == 1) show @endif">
            <div class="accordion-body">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="fw-bolder">#</th>
                                <th class="fw-bolder">Date Entry</th>
                                <th class="fw-bolder">Time In</th>
                                <th class="fw-bolder">Time Out</th>
                                <th class="fw-bolder">Late</th>
                                <th class="fw-bolder">UT</th>
                                <th class="fw-bolder">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dtr['data'] as $time_entry)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ \Carbon\Carbon::parse($time_entry->date_entry)->format('M. d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($time_entry->time_in)->format('h:i A') }}</td>
                                <td>{{ $time_entry->time_out ? \Carbon\Carbon::parse($time_entry->time_out)->format('h:i A') : '-' }}</td>
                                <td>
                                    @if (!($time_entry->late == "0" || $time_entry->late == "00:00"))
                                        {{ $time_entry->late }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if (!($time_entry->undertime == "0" || $time_entry->undertime == "00:00"))
                                        {{ $time_entry->undertime }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <code>{{ $time_entry->time_out ?  '-' : 'No Time out' }}</code>
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
            </div>
        </div>
    </div>
@endforeach