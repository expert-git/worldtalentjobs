<table>
    <tr>
        <td style="width:50px;">
            @if( $cert->mimetype == 'application/pdf')
                <img src="/icon-img/pdf.svg" id="certicon_{{$cert->id}}">
            @else
                <img src="/icon-img/other.svg">
            @endif
        </td>
        <td>
            <a href="/{{$cert->path}}" target="_blank">{{$cert->displayname}}</a>
        </td>
    </tr>
    <tr>
        <td>
            <button class="certfileinfobut">
                <img src="/icon-img/edit.svg" style="width:20px; height:20px;">
                <input type="file" id="certfile_{{$cert->id}}" data-id="{{$cert->id}}" name="certfile">
            </button>
        </td>
        <td style="padding-left:5px;">
            <img src="/icon-img/remove.svg" style="width:20px; height:20px;" onclick="removecert({{$cert->id}})" >
        </td>
    </tr>
</table>