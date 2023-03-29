<head>
    <title>DTR Printing - {{ request()->division }} Division | NBDB AMS</title>
    <style>
        html, body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
        }
        table{
            width: 100%;
        }
        .bold{
            font-weight: bold
        }
        .text-right{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
        .vertical-top{
            vertical-align: top;
        }
        .container{
            width: 100%;    
        }
        .container table{
            border-collapse: collapse;
        }
        .container table tr th,.container table tr td {
            border: 1px solid #666;
            padding: 6px;
        }
        .container table thead tr th{
            background:#666;
            padding:5px;
        }
        .container table tfoot tr td{
            font-weight:bold;
        }
        .date_entry{
            padding: 2px !important;
            font-size: 10px;
            text-align: center;
        }
        .total {
            font-size: 10px;
        }
        .page-break {
            page-break-after: always;
        }
        @page {
            margin: 0.5in 2in;
        }
    </style>
</head>

@foreach ($dtr_details as $dtr)
<div class="container">
    <table>
        <thead>
            <tr>
                <td colspan="9" class="bold text-center">
                    NATIONAL BOOK DEVELOPMENT BOARD
                    <br>
                    DAILY TIME RECORD
                </td>
            </tr>
            <tr>
                <td colspan="9" class="bold text-center">
                    @php
                        $date_inclusive = explode(" to ", request()->date_inclusive);
                        $start = \Carbon\Carbon::parse($date_inclusive[0]);
                        $end = \Carbon\Carbon::parse($date_inclusive[1]);
                        $startDateString = $start->format('F j');
                        $endDateString = $end->format('F j, Y');
                        if ($start->month === $end->month) {
                            $endDateString = $end->format('j, Y');
                        } else {
                            $endDateString = $end->format('F j, Y');
                        }
                        $dateRange = $startDateString . ' - ' . $endDateString;
                    @endphp

                    {{ $dateRange }}
                </td>
            </tr>
            <tr>
                <td colspan="2" class="bold">Name:</td>
                <td colspan="7" class="bold">
                    {{ $dtr['last_name'] }}, {{ $dtr['first_name'] }}
                </td>
            </tr>
            <tr>
                <td colspan="2" class="bold">Position:</td>
                <td colspan="7" class="bold"></td>
            </tr>
            <tr>
                <td colspan="2" class="bold">
                    Division/ <br>
                    Office:
                </td>
                <td colspan="7" class="bold">{{ $dtr['division'] }}</td>
            </tr>
            <tr>
                <td rowspan="2" class="bold text-center">DATE</td>
                <td rowspan="2" class="bold text-center">DAY</td>
                <td colspan="2" class="bold text-center">AM</td>
                <td colspan="2" class="bold text-center">PM</td>
                <td rowspan="2" class="bold text-center">LATE</td>
                <td rowspan="2" class="bold text-center">UT</td>
                <td rowspan="2" class="bold text-center">REMARKS</td>
            </tr>
            <tr>
                <td class="bold text-center">IN</td>
                <td class="bold text-center">OUT</td>
                <td class="bold text-center">IN</td>
                <td class="bold text-center">OUT</td>
            </tr>
        </thead>
        <tbody>
            @php
                $startDate = \Carbon\Carbon::parse($date_inclusive[0]);
                $endDate = \Carbon\Carbon::parse($date_inclusive[1]);
            @endphp

            @while ($startDate->lte($endDate))
                <tr>
                    <td class="text-center date_entry">
                        {{ $startDate->format('j') }}
                    </td>
                    @if ($dtr['data']->contains('date_entry', $startDate->format('Y-m-d')))
                        @php
                            $time_entry = $dtr['data']->firstWhere('date_entry', $startDate->format('Y-m-d'))
                        @endphp
                        <td class="date_entry"></td>
                        <td class="date_entry">{{ \Carbon\Carbon::parse($time_entry->time_in)->format('h:i A') }}</td>
                        <td class="date_entry"></td>
                        <td class="date_entry"></td>
                        <td class="date_entry">
                            {{ $time_entry->time_out ? \Carbon\Carbon::parse($time_entry->time_out)->format('h:i A') : '' }}
                        </td>
                        <td class="date_entry">
                            @if (!($time_entry->late == "0" || $time_entry->late == "00:00"))
                                {{ $time_entry->late }}
                            @endif
                        </td>
                        <td class="date_entry">
                            @if (!($time_entry->undertime == "0" || $time_entry->undertime == "00:00"))
                                {{ $time_entry->undertime }}
                            @endif
                        </td>
                        <td class="date_entry">{{ $time_entry->time_out ?  '' : 'No Time out' }}</td>
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                </tr>
                @php
                    $startDate->addDay();
                @endphp
            @endwhile
            <tr>
                <td colspan="6" class="text-right total bold">TOTAL</td>
                <td class="total">{{ $dtr['total_late'] }}</td>
                <td class="total">{{ $dtr['total_ut'] }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="9" class="text-center">
                    I CERTIFY on my honor that the above is a true and correct
                    <br>report of the hours of work performed, record of which was made daily at the time of arrival
                    <br>at and departure from office
                    <br>
                    <br>
                    <br>
                    <br>
                        <span class="bold">
                            {{ strtoupper($dtr['last_name']) }}, 
                            {{ strtoupper($dtr['first_name']) }}
                        </span>
                    <br>Employee's Name and Signature
                </td>
            </tr>
            <tr>
                <td colspan="9" class="text-center">
                    VERIFIED as to prescribed working hours
                    <br>  
                    <br>
                    <br>
                    <br>Signature of Division Chief/ Immediate Supervisor
                </td>
            </tr>
        </tbody>
    </table>
</div>

@if (!$loop->last)
<div class="page-break"></div>
@endif
@endforeach

<script type="text/javascript">
this.print(true)
</script>