<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th width="30%" class="text-nowrap">Name</th>
            <td>{{ $hospital_patient->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="text-nowrap">Email</th>
            <td>{{ $hospital_patient->email ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="text-nowrap">Contact</th>
            <td>{{ $hospital_patient->detail_user->contact ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="text-nowrap">Address</th>
            <td>{{ $hospital_patient->detail_user->address ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th class="text-nowrap">Gender</th>
            <td>
                @if(isset($hospital_patient->detail_user->gender))
                    @if($hospital_patient->detail_user->gender == 1)
                        Male
                    @else
                        Female
                    @endif
                @else
                    N/A
                @endif
            </td>
        </tr>
        <tr>
            <th class="text-nowrap">Created At</th>
            <td>{{ isset($hospital_patient->created_at) ? $hospital_patient->created_at->format('d F Y H:i:s') : 'N/A' }}</td>
        </tr>
        <tr>
            <th class="text-nowrap">Updated At</th>
            <td>{{ isset($hospital_patient->updated_at) ? $hospital_patient->updated_at->format('d F Y H:i:s') : 'N/A' }}</td>
        </tr>
    </table>
</div>
