<table id="maintable"  cellpadding="20" id="postlist" class="table table-striped" style="width:100%">
    <thead>
    <tr class="firstrow">
        <th width="12%"><b>Employer.ID</b></th>
        <th width="12%"><b>Employer</b></th>
        <th width="12%"><b>Job Title</b></th>
        <th width="14%"><b>Email</b></th>
        <th width="12%"><b>Phone Number</b></th>
        <th width="12%"><b>Registration Date</b></th>
        <th width="12%"><b>Expiry Date</b></th>
        <th width="12%"><b>Status</b></th>
    </tr>
    </thead>

    <tbody style="display: table-row-group;">
    @forelse($data as $j)
        <?php if($j->published==1)
        {
            $j->published="Active";
        }
        else
        {
            $j->published="Inactive";
        }
        ?>
        <tr>
            <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->id}}</a></td>
            <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->companyname}}</td>
            <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->jobtitle}}</td>
            <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->ContactEmail}}</td>
            <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->ContactPhone}}</td>
            <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->created_at}}</td>
            <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->deadline}}</td>
            <td><a href="/inspector/postdetails/{{$j->id}}">{{$j->published}}</td>
        </tr>



    @empty
        <p class="text-warning">No Job Found</p>

    @endforelse

    </tbody>

</table>

<div class="text-center"> {{$data->links()}}</div>