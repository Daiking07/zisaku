<tr class="comment-visible">
        <div id="comment-body"></div>
    <th scope="row"></th>
    <td>
        <li>{!! nl2br(e($item->comment)) !!}</li>
    </td>
    <td>{{ $item->created_at }}</td>
        <td>
            {{-- <button type="submit" id="{{$item->id}}" class="btn btn-danger comment-delete">削除</button> --}}
            <form action="{{route('comment.destroy',$item->id)}}" method="post">
                @csrf @method('delete')
                <button class="btn btn-danger" type="submit">削除</button>
            </form>
        </td>
</tr>