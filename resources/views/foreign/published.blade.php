@extends('layouts.app')
@section('content')
    <div style='margin-top:70px'></div>
    <div class='container'>
        @forelse ($allPublishes as $published_piece)

        <div class='row'>
            <div class='col-md-9 col-lg-9 col-md-offset-2'>
                    <div class='thumbnail-tune piece-post thumbnail piece-post-minimum-height solid-two-light' style='opacity:0.3' >
                        <div class='avatar-square solid-rank'>
                            <img src='{{asset($published_piece->profile_picture)}}' class=" pull-left img-responsive avatar-square img-thumbnail">
                        </div>
                        <h1 class='panel-title dark-knight'>{{$published_piece->publisher_name}}  <small class='{{$published_piece->publisher_rank.' label label default solid-rank dark-knight'}}'> {{$published_piece->publisher_rank}} </small></h1><hr class='piece-post-div'>
                        <small class='text-center' style='text-transform:uppercase; font-size:0.7em'>A piece from {{$published_piece->publisher_name}}</small>
                        <div class='piece-overflow'>
                            <p>

                                    <h4 class='dark-knight solid-text-light-two'>{{$published_piece->piece_title}}</h4>
                                    {{$published_piece->piece_body}}
                            </p>
                        </div>
                        {{-- ################################# FORM TO SUBMIT ON FULLPIECE CLICK ################--}}
                        <form id={{'full-piece-form'.$published_piece->id}} class="" action="{{route('piece.full',$published_piece->piece_title)}}" method="post">
                            {{csrf_field()}}
                            <input type='hidden' name='piece_id' value="{{$published_piece->id}}">
                        </form>
                        {{-- ################################################################### --}}
                        <div class='cover-piece-text clearfix'>
                            {{-- All piece tools over here --}}
                            <button data-piece-postID='{{$published_piece->id}}' class='btn btn-danger btn-xs solid-rank piece-modal-button' data-toggle='modal' data-target='{{'#piece-id'.$published_piece->id}}'style='background:maroon;'><span class='glyphicon glyphicon-sunglasses'></span> </button>
                            <button class='btn btn-primary solid-rank btn-xs' onclick='goToFullView("{{$published_piece->id}}")'>
                            Full view </button>
                            <div class=' pull-right ' id='{{'likes-and-coins-'.$published_piece->id}}' style='border-color:black;'>
                                {{-- check if the user has liked that piece, if so, change button color and show another button  --}}
                                @if(count($published_piece->likes) > 0)
                                    {{-- if the authenticates user has already like the post, show a button without the like-button class so they cant like it anymore...ELSE show a button with the like-button class --}}
                                    @if($published_piece->likes->where('user_id',Auth::user()->id)->first())
                                        <button class='merge-currency solid-two-light ' ></button>
                                        <small class='text text-muted dark-knight'>{{$published_piece->bank->coins}} </small>
                                        <button type="button" style='background-color:black; color:white ' data-piece-id='{{$published_piece->id}}' class=' btn-xs btn btn-default' data-toggle='tooltip' title='You like this.' data-placement='top'>{{count($published_piece->likes).' '}}
                                            <span class='glyphicon glyphicon-thumbs-up' style='color:cyan'></span>
                                        </button>
                                    @else
                                        <button class='merge-currency solid-two-light ' ></button>
                                        <small class='text text-muted dark-knight'>{{$published_piece->bank != null ? $published_piece->bank->coins :'0' }} </small>
                                        <button type="button" data-piece-id='{{$published_piece->id}}' class='btn-xs btn btn-default  like-button' >{{count($published_piece->likes).' '}}
                                            <span class='glyphicon glyphicon-thumbs-up'></span>
                                        </button>
                                    @endif
                                @else
                                    <button data-piece-id='{{$published_piece->id}}'  type="button" class='btn-xs btn btn-default like-button'>
                                        <span class='glyphicon glyphicon-thumbs-up' ></span>
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                    {{-- Individual piece skeleton --}}
                    <div class='modal fade' id='{{'piece-id'.$published_piece->id}}'>
                		<div class='modal-dialog modal-md'>
                			<div class='modal-content'>
                				<div class='modal-header'>
                					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
                					<h3 class='modal-title dark-knight'>{{$published_piece->piece_title}} skeleton</h3>
                				</div>
                				<div class='modal-body'>
                                    <textarea style='display:none' name="name" id='{{'piece-post-skeleton-data-'.$published_piece->id}}' rows="8" cols="80">{{$published_piece->skeleton_form}}</textarea>
                					<p id='{{'piece-post-skeleton-page-'.$published_piece->id}}'> </p>
                				</div>
                			</div>
                		</div>
                	</div>
                    {{-- End of thumbnail --}}
            </div>
            {{-- End of columns --}}
        </div>
        {{-- End of row --}}
    @empty
    @endforelse
    </div>
    {{-- End of container --}}

    <script type="text/javascript">
        var goToFullView = function(formID){
            event.preventDefault();
            var fullFormID = 'full-piece-form'+formID;
            document.getElementById(fullFormID).submit();
        };

    </script>
@endsection
@section('scripts')
    <script src="{{ asset('js/published.js') }}"></script>
@endsection
