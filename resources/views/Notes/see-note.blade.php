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
							<h4  class=" section-title dark-knight pull-left "><b>{{Auth::user()->name."'s piece --". $found_note->title }} <small> <span class='{{Auth::user()->rank.' label label-default solid-two-light dark-knight'}}'>{{Auth::user()->rank}}</span></small></b></h4>
							<div class="pull-right">
								<button class="btn btn-primary btn-sm  solid-two-light" id='skeleton-button' type='button' data-toggle='modal' data-target='{{ '#piece-skeleton' }}' style='background-color:maroon;'><i class=" glyphicon glyphicon-sunglasses"></i> </button>
								@if($found_note->published)
								@else
									<button class="btn btn-default btn-sm solid-two-light" type='button' data-toggle='modal' data-target='#publish-modal'><span class="glyphicon glyphicon-bookmark" style='color:maroon;'></span> Publish</button>
								@endif
								<button class="btn btn-primary btn-sm  solid-two-light" type='button' data-toggle='modal' data-target='{{ '#myModal'.$found_note->id }}'><i class="glyphicon glyphicon-edit"></i> Edit</button>
								<button class="btn btn-danger btn-sm  solid-two-light" type='button' data-toggle='modal' data-target='#deletNote'><i class="glyphicon glyphicon-trash"></i></button>
							</div>
					</div>
					<div class="solid-rank cover-piece-text" style='padding:3px;'>
						<pre  class='  cute-page' id ='note-view'> {{Crypt::decryptString($found_note->note)}}</pre>
					</div>
					<div class="cover-piece-text clearfix" style='border-color:black'>
						<small class=" pull-right pull-care" style="; font-size:0.75em;">
							<i class="glyphicon glyphicon-dashboard"></i> {{ $found_note->created_at->diffForHumans() }}
						</small>
						<a class="btn btn-default btn-sm solid-two-light" href="{{ route('home',Session::get('username')) }}" >
							<i class="glyphicon glyphicon-backward"></i>
						</a>
						<small class='text text-muted'> {{ count(explode(" ",Crypt::decryptString($found_note->note))).' words' }}</small>
						<button class='merge-currency solid-two-light '></button><small class='dark-knight label label-success'>{{$found_note->published == true ? $found_note->publish->bank->coins : '0'}}</small>
						<small class=' dark-knight label label-danger' style='color:white'>{{$found_note->published == true ? count($found_note->publish->likes): '0'}} <span class='glyphicon glyphicon-thumbs-up'></span></small>
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
										<span class='{{'label label default solid-rank dark-knight '.$comment->user->rank}}' >{{$comment->user->rank}}</span>
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
								<textarea rows='8' class='form-control' name='note' placeholder='Note over here'>{{ Crypt::decryptString($found_note->note) }}</textarea>
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
						<textarea name="piece_body" class='hide' rows="8" cols="80">{{Crypt::decryptString($found_note->note)}}</textarea>
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
@endsection
