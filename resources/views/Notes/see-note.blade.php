@extends('layouts.app')

@section('content')
	<div class='container'>
		<div class="row">
			<div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 " id="seePane">
				@if(Session::has('success'))
					 <p class="alert alert-success">{{ Session::get('success') }}</p>
				@endif
				<div class='thumbnail-tune thumbnail'>
					<div class=" clearfix">
							{{-- check if it is the creator of this piece that is there to view --}}
							@if(Auth::user()->id == $found_note->user_id)
								<h4  class=" section-title dark-knight pull-left "><b>{{Auth::user()->name."'s piece --". $found_note->title }} <small> <span class='{{Auth::user()->rank->rank.' label label-default solid-two-light '}}'>{{Auth::user()->rank->rank}}</span></small></b></h4>
								<div class="pull-right">
									<button class="btn btn-primary btn-sm  solid-two-light" id='skeleton-button' type='button' data-toggle='modal' data-target='{{ '#piece-skeleton' }}' style='background-color:maroon;'><i class=" glyphicon glyphicon-sunglasses"></i> </button>
									@if($found_note->published)
									@else
										<button class="btn btn-default btn-sm solid-two-light" type='button' data-toggle='modal' data-target='#publish-modal'><span class="glyphicon glyphicon-bookmark" style='color:maroon;'></span> Publish</button>
									@endif
									<button class="btn btn-primary btn-sm  solid-two-light" type='button' data-toggle='modal' data-target='{{ '#myModal'.$found_note->id }}'><i class="glyphicon glyphicon-edit"></i> Edit</button>
									<button class="btn btn-danger btn-sm  solid-two-light" type='button' data-toggle='modal' data-target='#deletNote'><i class="glyphicon glyphicon-trash"></i></button>
								</div>
							@elseif (Auth::user()->is_mentor)
								<h4  class=" section-title dark-knight pull-left ">
									<b>{{App\User::where('id',$found_note->user_id)->first()->name."'s piece --". $found_note->title }}
										<small> <span class='{{App\User::where('id',$found_note->user_id)->first()->rank->rank.' label label-default solid-two-light dark-knight'}}'>{{App\User::where('id',$found_note->user_id)->first()->rank->rank }}
										</span></small>
									</b>
								</h4>
							@else
								<h3  class=' text text-danger solid-text-light-two'>LEAVE IMMEDIATELY!</h3>

							@endif
					</div>
					<div class="solid-rank cover-piece-text" style='padding:3px;'>
						<pre  class='  cute-page' id ='note-view'> {{ Auth::user()->id == $found_note->user_id || Auth::user()->is_mentor ? $found_note->note : 'YOU ARE TRESSPASSING. PLEASE LEAVE! THIS PIECE CAN ONLY BE SEEN BY OTHERS ONLY IF IT IS PUBLISHED OTHERWISE, IT IS PRIVATE. THE LONGER YOU STAY ON THIS PAGE INCREASES YOUR CHANCES OF BEING CHARGED WITH PLAGIARISM, WHICH WILL SURELY RESULT IN THE TERMINATION OF YOUR ACCOUNT. '}}</pre>
					</div>
					<div class="cover-piece-text clearfix" style='border-color:black'>
						<small class=" pull-right pull-care" style="; font-size:0.75em;">
							<i class="glyphicon glyphicon-dashboard"></i> {{ $found_note->created_at->diffForHumans() }}
						</small>
						<div class="pull-left">
							<a class="btn btn-default btn-sm solid-two-light" href="{{ route('home',Session::get('username')) }}" >
								<i class="glyphicon glyphicon-backward"></i>
							</a>
							<small class='text text-muted'> {{ count(explode(" ",$found_note->note)).' words' }}</small>
							<button class='merge-currency solid-two-light '></button><small class='dark-knight label label-success'>{{$found_note->published == true ? $found_note->publish->bank->coins : '0'}}</small>
							<small class=' dark-knight label label-danger' style='color:white'>{{$found_note->published == true ? count($found_note->publish->likes): '0'}} <span class='glyphicon glyphicon-thumbs-up'></span></small>

							<small class='fontlize label label-default broni mouse' style='background:crimson' data-toggle='popover' data-title='Grabbers' data-content='
							<h6 class="dark-knight"><b>People who have grabbed this</b></h6>
							<hr class="normal-merge-div" style="margin-top:3px; max-height:100px; overflow-y:scroll;">
							<div class="">
								@foreach($found_note->publish->grabbers as $G)
									<div class="cover-piece-text" style="padding:2px;   border-color:black; border-width:1px;">
										<small class="dark-knight">{{$G->name}}</small><br>
									</div>

								@endforeach
							</div>
							' data-html='true'>
								<span>
									 Grabbers: {{ $found_note->published != false ? $found_note->publish->grabbers != null ? count($found_note->publish->grabbers) : ' 0': ' 0'}}</span>
							</small>
						</div>
					</div>
				</div>
			</div>
			{{-- Keep skeleton text --}}
			<textarea id='keep-skeleton' class='hide' rows="8" cols="80">{{ $found_note->skeleton_form}}</textarea>

			<div class='col-md-4 col-lg-4 col-sm-12 col-xs-12 space thumbnail-tune thumbnail solid-two-light' style='margin-top:70px' >
				<button data-toggled='true' id='show-comments' class='btn btn-default pull-right'><span class='caret'></span></button>
				 <h4 class='section-title clearfix dark-knight pull-care'>
					 <b>Comments</b> <span class='badge'>{{$found_note->published == true ? $found_note->publish->comments != null ? count($found_note->publish->comments) : '0' : 'Not published'}}</span>
				</h4>
			</div>
			<div class='col-md-4 col-lg-4 col-sm-12 col-xs-12 space thumbnail-tune thumbnail solid-two-light' id='comment-box' >
				<div id='comment-items'>

						@if($found_note->published)
							@if($found_note->publish->comments !=null)
								@foreach ($found_note->publish->comments as $comment)
									<div class=" cover-piece-text" style='border-color:black; border-width:1px;' >
										<h5 class='label label-default solid-rank solid-text-light-two' style='background-color:purple'>{{$comment->user->name}}</h5>
										<small style='opacity:0'></small>
										<span class='{{'label label default solid-rank '.$comment->user->rank->rank}}' >{{$comment->user->rank->rank}}</span>
										<small class='text-center dark-knight'>{{$comment->comment}}</small>
									</div>
								@endforeach
							@else
								<small>There are no comments!</small>
							@endif
						@else
							<small>This piece has not being published yet!</small>
						@endif
				</div>
			</div>
			<div class='col-md-4 col-lg-4 col-sm-12 col-xs-12 space thumbnail-tune thumbnail solid-two-light clearfix' id='mentor-side'>
				@if(Auth::user()->is_mentor)
					<center>
						<h4 class='dark-knight'>{{Auth::user()->name.' '}}</h4>
						<button class='btn btn-default solid-rank btn-large remarks-color' data-toggle='popover' data-title='Mentor score and remarks' data-placement='bottom' data-html='true' data-content='
							<form action="/mentor-mark" class="clearfix" method="get">
								<textarea name="remarks" rows="6" class="form-control" style="width:100%" placeholder="This can be left empty, but it would very nice if you let your mentee know your thoughts."></textarea>
								<input type="hidden" name="piece_id" value="{{$found_note->id}}">
								<button class="btn btn-success btn-sm solid-rank pull-right" style="margin:5px 5px;"><span class="glyphicon glyphicon-ok" ></span> Mark</button>
								<input type="number" name="mark_coins" value="10" class="form-control" style="width:65%; margin:2px" max="100">
							</form>
						' >Add remarks and score</button>
					</center>

				@else
					<center>
						<h3 class='dark-knight solid-text-light-two'>MENTORS</h3>
						<p class='dark-knight'>Before you publish anything, you can choose a mentor to let them see it first. They will read and bring out some vital information about your piece. Your mentor can grade you well with a few coins if your piece is worth it. Let them clean your piece up before you let it out into the world.</p>
					</center>
					@if($found_note->marked ==1)
						<center>
							<button class='btn btn-primary solid-rank btn-large receive-remark' data-toggle='popover' data-title='Mentor score and remarks' data-placement='top' data-html='true' data-content='
								<p class="dark-knight">{{$found_note->mentor_remark}}</p>
								<input type="text" class="form-control pull-right" value="{{$found_note->mark_coins.' coins'}}" style="background:black; color:white; width:90px; border:solid 3px crimson;" readonly>
							' >Remarks from your mentor</button>
							<button type='button' id='seen' data-ID='{{$found_note->id}}'class='btn btn-success' style='background:green' data-toggle='tooltip' data-placement='top' title='Mark this as seen'><span class='glyphicon glyphicon-eye-open'></span></button>
						</center>
					@elseif ($found_note->marked==2)
						<div class="cover-piece-text solid-rank dark-knight" style='background:green'>
							<p style='color:white; border-color:black;'>Waiting for mentor...</p>
						</div>

					@else
						<div class="row">
							<div class='dropdown'>
								<input type="text" name="mentor_name" class='form-control pull-left' id='mentor-box' style='width:80%;' placeholder="Choose a mentor" value="">
								<input type="hidden" id="mentor_id" value="">
								<input type="hidden" id='piece-id-men' name="" value="{{$found_note->id}}">
								<input type="hidden" id='piece-title-men' name="" value="{{$found_note->title}}">
								<button type="button" data-toggle='dropdown' data-opened='false' class='dropdown-toggle btn btn-default ' id='mentor' name="button"><span class='caret'></span></button><button class='btn btn-success solid-rank' style='margin-left:5px;margin-right:5px; display:none' id='send-to-mentor'><span class='glyphicon glyphicon-send'></span> send</button>
								<ul class='dropdown-menu my-drop' role='menu' aria-labelledby="mentor" style='width:300px;' >
									<li role='presentation'><small class='dropdown-header' >Choose a mentor</small></li>
									<li role='presentation' class='divider'></li>
									@forelse ($mentors as $mentor)
											<li data-ID='{{$mentor->id}}' ><a  class=' mouse'  >{{$mentor->name}}</a></li>
									@empty
											<li ><a  class=' mouse'  >There are no mentors available</a></li>
									@endforelse
								</ul>
							</div>
						</div>
					@endif
				@endif

			</div>
		</div>
		{{-- EDIT MODAL --}}
		<form action='{{ route('edit.note',$found_note->id) }}' method='get'>
			<div class="modal fade" id='{{ 'myModal'.$found_note->id }}'>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
							<h4 class='modal-title'>Edit Note</h4>
						</div>
						<div class='modal-body'>
							<div class='form-group'>
								<br>
								<label for=''>Title</label>
								<input type='name' class='form-control'  value="{{ $found_note->title }}" name='title'>
								<label for=''>Note</label>
								<textarea rows='8' class='form-control' name='note' placeholder='Note over here'>{{$found_note->note }}</textarea>
								<textarea name="skeletal_form" class='hide' rows="8" cols="80">{{$found_note->skeleton_form}}</textarea>
							</div>
						</div>
						<div class='modal-footer'>
							<button class='btn btn-info' type='submit'><span class='glyphicon glyphicon-save'></span> Save</button>
							<button class='btn btn-warning' type='button' data-dismiss='modal'>Close</button>
						</div>
						<textarea name="piece_skeleton_form" class='hide' id='skeleton_box' rows="8" cols="80">{{$found_note->skeleton_form}}</textarea>
					</div>
				</div>
			</div>
		</form>
	</div>

	<!-- ######################## DELETE MODAL ################### -->
	<div class='modal fade' id='deletNote'>
		<div class='modal-dialog modal-sm'>
			<div class='modal-content'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
					<h3 class='modal-title'>Delete</h3>
				</div>
				<div class='modal-body'>
					<small>Are you sure you want to delete '<b>{{ $found_note->title }}</b>'</small>
				</div>
				<div class='modal-footer'>
					<form action="{{ route('delete.note',$found_note->id) }}" method="get">
						<button class="btn btn-danger btn-sm solid-two-light"  type='submit'><i class="glyphicon glyphicon-trash"></i> Yes</button>
					</form>

				</div>
			</div>
		</div>
	</div>


	<!-- ######################## PUBLISH  MODAL ################### -->
	<div class='modal fade' id='publish-modal'>
		<div class='modal-dialog modal-sm'>
			<div class='modal-content'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
					<h3 class='modal-title'>Confirm</h3>
				</div>
				<div class='modal-body'>

					<small>Please confirm that you want to publish '<b>{{ $found_note->title }}</b>'</small>
				</div>
				<div class='modal-footer'>
					<form action="" method="get">
						<a href='{{route('publish',$found_note->id)}}' class="btn btn-default btn-sm solid-two-light" style='color:white; background:maroon;' type='submit'><i class="glyphicon glyphicon-ok"></i> Yes, I want to publish this piece</a>
					</form>

				</div>
			</div>
		</div>
	</div>




	{{-- SKELETON MODAL --}}
	<form action='{{ route('revamp',$found_note->id) }}' method='post'>
		{{csrf_field()}}
		<div class="modal fade" id='{{ 'piece-skeleton' }}'>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
						<h4 class='modal-title'>Your piece in its skeleton</h4>
					</div>
					<div class='modal-body'>
						<input type="text" class='hide' name="piece_title" value="{{$found_note->title}}">
						<textarea name="piece_body" class='hide' rows="8" cols="80">{{$found_note->note}}</textarea>
						<p id='piece-skeleton-page'></p>

					</div>
					<div class='modal-footer'>
						<button type='submit' class='btn btn-primary solid-text-light-two' type='button' style='background:black; color:white;' data-toggle='tooltip' title='Revamp will help you reselect all the devices you identified when you were making this piece.' data-placement='left' >Revamp</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<style>
		#seePane{
			position:absolute;

		}
	</style>
@endsection
@section('scripts')
	<script src="{{ asset('js/seePiece.js') }}"></script>
	<script src="{{ asset('js/universal.js') }}"></script>
@endsection
