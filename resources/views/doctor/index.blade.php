@extends('layouts.app')

@push('css')
@endpush

@section('content')
@if(count($candidates) > 0)
<table class="datatable-init-export nowrap table" data-export-title="Export">
    <thead>
    <tr>
        <th>SL</th>
        <th>User Id</th>
        <th>Applicant Name</th>
        <th>Position</th>
        <th>Mobile No</th>
        <th>Age</th>
        <th>Pay Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php $i = 1 ?>
    @foreach($candidates as $candidate)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $candidate->JobApply->identification_number }}</td>
        <td>{{ $candidate->full_name_english }}</td>
        <td>{{ $candidate->position_name }}</td>
        <td>{{ $candidate->mobile_number }}</td>
        <td>{{ json_decode($candidate->age)[2]  }} Years</td>
        <td>{{ $candidate->JobApply->status }}</td>
        <td class="nk-tb-col nk-tb-col-tools">
            <ul class="nk-tb-actions gx-1">
                <li>
                    <div class="drodown">
                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="link-list-opt no-bdr">
                                <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                <li><a href="#"><em class="icon ni ni-repeat"></em><span>Transaction</span></a></li>
                                <li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                <li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset Id</span></a></li>
                                <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
                                <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@else
    <h3 class="text-center text-danger">Currently Non of Candidate is Applied</h3>
@endif
@endsection

@push('js')
<script src="{{ asset('js/datatable-btns.js?ver=2.9.1') }}"></script>
@endpush