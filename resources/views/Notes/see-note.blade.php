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
							<small class=" pull-right pull-care" style="; font-size:0.75em;"><i class="glyphicon glyphicon-dashboard"></i> {{ $found_note->created_at->diffForHumans() }}</small>
							<h4 class=" section-title dark-knight "><b>{{Auth::user()->name."'s piece --". $found_note->title }} <small> <span class='{{Auth::user()->rank.' label label-default solid-two-light dark-knight'}}'>{{Auth::user()->rank}}</span></small></b></h4>
					</div>
				</div>

					{{-- <div class="box solid-two" style="min-height:400px; max-height:400px;background: rgba(255,255,255,0.5) overflow-y:scroll;"> --}}
					<pre  class=' solid-rank cute-page pre-for-phone' id ='note-view' style='font-family:"Josefin Slab","Helvetica Neue",Helvetica,Arial,sans-serif; border-width:0px; border-radius:0px;padding:40px 20px; font-size:1em; border: solid 10px maroon; '> {{Crypt::decryptString($found_note->note)}}</pre>
					{{-- </div> --}}

				<div class="thumbnail-tune thumbnail col-lg-12 col-md-12  col-xs-12 col-sm-12 solid-two-light">
					<button class="btn btn-danger btn-sm pull-right solid-two-light" type='button' data-toggle='modal' data-target='#deletNote'><i class="glyphicon glyphicon-trash"></i></button>


					<button class="btn btn-primary btn-xs pull-right solid-two-light" style="opacity:0.0"></button>
					<button class="btn btn-primary btn-sm pull-right solid-two-light" type='button' data-toggle='modal' data-target='{{ '#myModal'.$found_note->id }}'><i class="glyphicon glyphicon-edit"></i> Edit</button>
					<button class="btn btn-primary btn-xs pull-right solid-two-light" style="opacity:0.0"></button>
					<button class="btn btn-primary btn-sm pull-right solid-two-light" type='button' data-toggle='modal' data-target='{{ '#myModal'.$found_note->id }}' style='background-color:maroon;'><i class=""></i> Skeleton</button>
					<a class="btn btn-default btn-sm solid-two-light" href="{{ route('home',Session::get('username')) }}" ><i class="glyphicon glyphicon-backward"></i></a>

						<small class='text text-muted'> {{ count(explode(" ",Crypt::decryptString($found_note->note))).' words' }}</small>
						<button class='merge-currency solid-two-light '></button><small class='text text-muted'>60</small>
						<small class='text text-muted'><span class='glyphicon glyphicon-thumbs-up'></span> 500</small>

				</div>

			</div>


			<div class='col-md-4 col-lg-4 col-sm-12 col-xs-12 space thumbnail-tune thumbnail solid-two-light' style='margin-top:70px' >
				<button data-toggled='true' id='show-comments' class='btn btn-default pull-right'><span class='caret'></span></button>
				 <h4 class='section-title clearfix dark-knight pull-care'>
					 <b>Comments</b> <span class='badge'>40</span>
				</h4>
			</div>
			<div class='col-md-4 col-lg-4 col-sm-12 col-xs-12 space thumbnail-tune thumbnail solid-two-light' id='comment-box' style=' background:lightpink;'>
				<div id='comment-items'>
					<center >
						<div class='comment solid-two' style='background-color:black; color:white;'>
							<small> <span class='label label-warning'>Frimi</span><br> Nigga I coined you.. lol.Nigga I coined you.. lol.Nigga I coined you.. lol.Nigga I coined you.. lol.Nigga I coined you.. lol.</small>
						</div>
						<div class='comment solid-two' style='background-color:black; color:white;'>
							<small> <span class='label label-danger'>Sarah</span><br> This is a very good piece, you are truly a shakespare.</small>
						</div>
					</center>
				</div>
			</div>
		</div>


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
							</div>
						</div>
						<div class='modal-footer'>
							<button class='btn btn-info' type='submit'><span class='glyphicon glyphicon-save'></span> Save</button>
							<button class='btn btn-warning' type='button' data-dismiss='modal'>Close</button>
						</div>
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
	<style>
		#seePane{
			position:absolute;

		}
	</style>
@endsection
@section('scripts')
	<script src="{{ asset('js/merge.js') }}"></script>
@endsection
