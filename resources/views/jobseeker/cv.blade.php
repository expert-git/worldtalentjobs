<table>
    <tr>
        <td style="width:50px;">
            @if( $cv->mimetype == 'application/pdf')
                <img src="/icon-img/pdf.svg" id="icon_{{$cv->id}}">
            @else
                <img src="/icon-img/other.svg">
            @endif
        </td>
        <td>
            <a href="/{{$cv->path}}" target="_blank">{{$cv->displayname}}</a>
        </td>
    </tr>
    <tr>
        <td>
            <button class="certfileinfobut">
                <img src="/icon-img/edit.svg" style="width:20px; height:20px;">
                <input type="file" id="cvfile_{{$cv->id}}" data-id="{{$cv->id}}" name="cvfile">
            </button>
        </td>
        <td style="padding-left:5px;">
            <img src="/icon-img/remove.svg" style="width:20px; height:20px;" onclick="removecv({{$cv->id}})" >
        </td>
    </tr>
</table>