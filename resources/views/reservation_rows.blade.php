<tr>
    <td style="width: 21%;">Name</td>
    <td style="width: 14%">Table</td>
    <td style="width: 17%">Date</td>
    <td style="width: 17%">Fee</td>
    <td style="width: 17%">Status</td>
    <td style="width: 14%; text-align: center">Action</td>
</tr>
@foreach($reservations as $data)
<tr>
    <td>
        <div style="display: flex; flex-direction: row; line-height: 1.2"> 
            <img style="width: 45px; height: 45px; border-radius: 45px;" src="storage/{{ $data->profile_picture }}"/>
            <div style="display: flex; flex-direction: column; margin-left: 5px"> 
                <label style="margin-left: 5px;"> {{ $data->name }} </label>     
                <label style="margin-left: 5px;"> {{ $data->email }} </label>     
            </div>
        </div>
    </td>
    <td>{{ $data->table_name }}</td>
    <td>{{ date('d M Y h:i', strtotime($data->reservation_date)); }}</td>
    <td>Rp {{ number_format($data->fee, 0, ',', '.') }},00</td>
    <td>{{ $data->status }}</td>
    <td>
        <div style="display: flex; justify-content: center; align-items: center;">
            <button style="width: 125px; height: 35px; border-radius: 25px; background-color: #392A23; border: none; color: white" data-resid="{{$data->id}}" data-tabid="{{$data->table_id}}" onclick="showUpdateModal(this)">Update</button>
        </div>
    </td>
</tr>
@endforeach