{{-- check if the user has liked that piece, if so, change button color and show another button  --}}
@if(count($published_piece->likes) > 0)
    @if($published_piece->likes->where('user_id',Auth::user()->id)->first())
        <button class='merge-currency solid-two-light ' ></button>
        <small class='text text-muted dark-knight'>{{$published_piece->bank->coins}} </small>
        <button type="button" data-piece-id='{{$published_piece->id}}' class='btn-xs btn btn-default' data-toggle='popover' title='You like this.' style='background-color:black; color:white' data-placement='top'>{{count($published_piece->likes).' '}}
            <span class='glyphicon glyphicon-thumbs-up' style='color:cyan'></span>
        </button>
    @else
        <button class='merge-currency solid-two-light ' ></button>
        <small class='text text-muted dark-knight'>{{$published_piece->bank != null ? $published_piece->bank->coins :'0' }} </small>
        <button type="button" data-piece-id='{{$published_piece->id}}' class='btn-xs btn btn-default like-button' data-toggle='popover' title='You like this.' data-placement='top'>{{count($published_piece->likes).' '}}
            <span class='glyphicon glyphicon-thumbs-up'></span>
        </button>
    @endif
@else
    <button data-piece-id='{{$published_piece->id}}'  type="button" class='btn-xs btn btn-default like-button'>
        <span class='glyphicon glyphicon-thumbs-up' ></span>
    </button>
@endif
