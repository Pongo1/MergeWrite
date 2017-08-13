@extends('layouts.app')

@section('content')

	<div style="margin-top:70px;"></div>
	<div class='container'>
		<div class="row" style=''>
			<div class=" col-lg-8 col-md-8 col-sm-12 col-xs-12 " id="makePane">
				<div class='thumbnail thumbnail-tune school-paper solid-light-two' style="">
					<h4 class='modal-title dark-knight'><b>What's on your mind</b><a href='{{ route('home',Session::get('username')) }}' class='close pull-right' aria-hidden='true' type='submit'><small class="solid-text-light"><b>x</b></small></a></h4>
					<form id='pieceForm' action='{{ route('save.note',Auth::user()->id) }}' method='get'>
						<div class='form-group clearfix'>
							<br>
							<label for='' class="dark-knight">Title</label>
							<input type='name' class='form-control solid-rank'  value ='{{Session::has('temporaryPiece') ? Session::get('temporaryPiece')['title'] : ''}}'id ='piece-title' placeholder='title' name='title'>
							<br>
							<label for='' class="dark-knight" >Note</label>
							<div id='piece-body-coat'>
								<textarea rows='13'  class='form-control solid-rank clearfix' id ='piece-body' name='note' placeholder='Express yourself'>{{Session::has('temporaryPiece') ? Session::get('temporaryPiece')['body'] : ''}}</textarea>
							</div>
							<hr class='normal-merge-div'>
								<button class='btn btn-danger solid-rank' id='skeleton-button' type='button' data-toggle='modal' data-target='#skeleton-modal'><span class='glyphicon glyphicon-sunglasses' data-toggle='tooltip' title='Your can view your piece in skeleton form over here!' data-placement ='right'></span></button>
								<button  class='btn btn-danger solid-rank' type='button' style='color:white; background:maroon;' data-toggle='modal' data-target='#device-modal'><span data-toggle='tooltip' title='This will help you see all your english devices' data-placement ='right' class='glyphicon glyphicon-option-vertical'></span></button>
								{{-- PIECE'S SKELETAL FORM IS FIXED INTO THESE TEXTBOXES TO BE SENT WITH THE NORMAL REQUEST --}}
								{{-- These box are reset every 5 seconds with the current devices in use. check > Newpiece.js --}}
								<textarea name="piece_skeletal_form" style='display:none' id='piece-skeletal-form' rows="8" cols="80">{{Session::has('temporaryPiece') ? Session::get('temporaryPiece')['skeletal_form'] : ''}}</textarea>
								<textarea name="mother_names" style='display:none' id='mother-names-sending' rows="8" cols="80"></textarea>
								<textarea name="mother_values" style='display:none' id='mother-values-sending' rows="8" cols="80"></textarea>
								{{-- ####################################################################################################################### --}}
								<small class='text text-suscess' id='temporarilySaved' style='display:none; font-style:italic;'>Saving temporarily...</small>

								<input type='hidden' name='pieceRevampID' value="{{Session::has('revamp') ? $pieceRevampID : ''}}">

								@if(Session::has('revamp'))
									<button onclick='(submitForm("/cancel-revamp/"))' id='revampButton' class='btn btn-default pull-right solid-rank' style='background-color:red; color:white;'> Cancel </button>
									<button class="btn btn-primary btn-xs pull-right solid-two-light" style="opacity:0.0"></button>
									<button onclick='(submitForm("/save-revamped/"))' id='revampButton' class='btn btn-success pull-right solid-rank'> Finalise revamp</button>
								@else
									<button class='btn btn-success pull-right solid-rank' type='submit'><span class='glyphicon glyphicon-save'></span> Save</button>
								@endif

						</div>
						{{-- THERE ARE TWO HIDDEN BOXES HERE THAT COLLECT ALL DEVICE NAMES WITH THEIR ASSOSCIATE TEXTS  --}}
						{{-- These devices are taken from the session, which has the latest devices the user is using --}}
							<div id ='forSkeletonView'>
								@if(Session::has('DeviceBag'))
									@php
										$deviceMotherValues ='';
										$deviceMotherText = '';
										foreach (Session::get('DeviceBag')->devices as $mother => $text) {
											if($deviceMotherValues ==''){
												$deviceMotherValues = $deviceMotherValues.(string)$text['name'];
												$deviceMotherText = $deviceMotherText.$text['text'] ;
											}else{
												$deviceMotherValues = $deviceMotherValues.'<--->'.(string)$text['name'];
												$deviceMotherText = $deviceMotherText.'<--->'.$text['text'];
											}
										}
										//THE TEXTS IN THESE BOXES WILL BE LATER BROKEN DOWN IN JS TO BE USED
										echo "<input class='form-control' style='display:none'  value='".$deviceMotherValues."' id='deviceMotherNames' type='text'>";
										echo "<textarea class='form-control' style='display:none' id='deviceTextClosed'>".$deviceMotherText."</textarea>";
									@endphp
								@endIf
							</div>
					</form>
				</div>
			</div>
			<div class='col-lg-4 col-md-4 col-sm-12 col-xs-12'>
				<div class='thumbnail  thumbnail-tune  phone-dev-tools-fix'>
					<center>
						<small class='label label-success' style='opacity:0.01' id='saveStatus'>...</small>
						<h4 class='section-title dark-knight'>Piece developement tools</h4>
						<small style='text-transform:uppercase;'>These are some of the tools that will help you indicate what particular devices and forms of expressions you will use in your piece to help all readers learn  from your piece.</small>
					</center>
					<div class='dropdown'  id='devicesInUseContent'>
						{{-- SHOW USERS WHAT DEVICES THEY HAVE USED WITH A DROP DOWN --}}
						@if(Session::has('devicesExist'))
							<button type='button' class='btn btn-success solid-rank solid-text-light-two dropdown-toggle' style='width:100%; color:white; background-color:maroon;' id='devicesInUse' data-toggle='dropdown' ><span class='badge'>{{Session::get('DeviceBag')->deviceNumber}}</span> Devices in use <span class='caret'></span></button>
						    <ul class='dropdown-menu' role='menu' style='width:100%' aria-labelledby="devicesInUse">
						        <li role='presentation' class='dropdown-header'>Devices indicated</li>
						        <li role='presentation' class='divider'></li>
						        @foreach (Session::get('DeviceBag')->devices as $device)
						            <li role='presentation'><a style='cursor: pointer;' role='menuitem' data-toggle='tooltip' data-placement='right' title='{{$device['name']."s you have indicated."}}'>{{$device['name']}} <span class='badge'>{{count(explode(':'.$device['name'].'-mark'.':',$device['text']))}}</span></a></li>
						        @endforeach
						    </ul>
						@endif
					</div>
				</div>
				<div class='thumbnail  thumbnail-tune' >
					<div>
                        <img src={{asset('imgs/avartar-samurai.svg')}} class='mini-avatar mini-avatar-opposite' data-toggle='tooltip' data-placement='right' title="Pongo: There are a bunch of literary devices already provided for you. Just write and drag and drop to indicate where any literary device has been used in your piece. Isn't this cool? You can add any other devices that you cant find in the box below. ">
                    </div>
					<div class='form-group'>
						<form action="" method="">
							<button type='submit' class='btn btn-default pull-right'><span class='glyphicon glyphicon-plus'></span></button>
							<input class='form-control' type='text' name='english_tip' style='width:85%' placeholder="new device">
						</form>
					</div>
						@if(Session::has('revamp'))
							<small class='tex-center'>You are in revamp mode, reselect all devices in your piece and save!</small>
						@endif
					<div class='cover-piece-text' id='device-mark-board' data-called-already='' style='display:none;margin-bottom:5px;'>
						<small class='dark-knight' id='device-mark-title'>Sticker Name</small>
						<textarea class='form-control popover-width' rows='3' id='device-mark-box'></textarea>
						<button class='btn btn-primary btn-xs' id='device-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' id='device-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='device-show-button'>Show All </button>
					</div>

					<small data-metaphor-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(1,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[1]['text'] : "" : ""}}' id='Metaphor-sticker' class='label label-warning eng-tips solid-rank' data-title='Metaphor' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Metaphor-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Metaphor-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style ='display:none' id='Metapor-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Metaphor-show-button'>Show All </button>
					"> metaphor	</small>

					<small data-simile-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(2,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[2]['text'] : "" : ""}}' id='Simile-sticker' class='label label-primary solid-rank eng-tips' data-title='Simile' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Simile-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Simile-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Simile-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Simile-show-button'>Show All </button>
					"> simile </small>

					<small data-pun-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(3,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[3]['text'] : ""  : ""}}' id='Pun-sticker' class='label label-danger solid-rank eng-tips' data-title='Pun' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Pun-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Pun-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Pun-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Pun-show-button'>Show All </button>
					"> pun </small><br>

					<small data-Proverb-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(4,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[4]['text'] : "" : ""}}' id='Proverb-sticker' class='label label-default solid-rank eng-tips'  data-title='Proverb' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Proverb-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Proverb-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Proverb-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Proverb-show-button'>Show All </button>
					"> proverb </small>

					<small data-Alliteration-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(5,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[5]['text'] : "" : ""}}' id='Alliteration-sticker' class='label label-success solid-rank eng-tips'  data-title='Alliteration' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Alliteration-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Alliteration-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Alliteration-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Alliteration-show-button'>Show All </button>
					"> alliteration </small><br>

					<small data-Allegory-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(6,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[6]['text'] : "" : ""}}' id='Allegory-sticker' class='label label-danger pink-panther solid-rank eng-tips'  data-title='Allegory' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Allegory-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Allegory-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Allegory-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Allegory-show-button'>Show All </button>
					"> allegory </small>

					<small data-Euphemism-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(7,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[7]['text'] : "" : ""}}'
					 id='Euphemism-sticker' class='label label-danger solid-rank eng-tips' style='background-color:blue '  data-title='Euphemism' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Euphemism-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Euphemism-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Euphemism-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Euphemism-show-button'>Show All </button>
					"> Euphemism </small><br>

					<small data-Foreshadowning-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(8,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[8]['text'] : "" : ""}}'
					id='Foreshadowing-sticker' class='label label-danger solid-rank eng-tips dark-knight' style='background-color:cyan; color:black; '  data-title='Foreshadowing' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Foreshadowing-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Foreshadowing-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Foreshadowing-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Foreshadowing-show-button'>Show All </button>
					"> Foreshadowing </small>

					<small data-Imagery-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(9,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[9]['text'] : "" : ""}}'
					id='Imagery-sticker' class='label label-danger solid-rank eng-tips dark-knight' style='background-color:lime '  data-title='Imagery' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Imagery-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Imagery-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Imagery-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Imagery-show-button'>Show All </button>
					"> Imagery </small><br>


					<small data-Personification-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(10,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[10]['text'] : "" : ""}}'
					id='Personification-sticker' class='label label-danger solid-rank eng-tips' style='background-color:red '  data-title='Personification' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Personification-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Personification-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Personification-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Personification-show-button'>Show All </button>
					"> personification </small>

					<small data-Epigraph-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(11,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[11]['text'] : "" : ""}}'
					   id='Epigraph-sticker' class='label label-danger solid-rank eng-tips dark-knight' style='background-color:orange '  data-title='Epigraph' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Epigraph-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Epigraph-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Epigraph-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Epigraph-show-button'>Show All </button>
					"> Epigraph </small><br>

					<small data-Hyperbole-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(12,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[12]['text'] : "" : ""}}'
					 id='Hyperbole-sticker' class='label label-danger solid-rank eng-tips' style='background-color:black '  data-title='Hyperbole' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='pun-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Hyperbole-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Hyperbole-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Hyperbole-show-button'>Show All </button>
					"> Hyperbole </small>

					<small data-Idiom-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(13,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[13]['text'] : "" : ""}}'
						id='Idiom-sticker' class='label label-danger solid-rank eng-tips dark-knight' style='background-color:white '  data-title='Idiomatic-expression' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Idiom-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Idiom-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Idiom-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Idiom-show-button'>Show All </button>
					"> Idiomatic-expression </small><br>

					<small data-Anecdote-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(14,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[14]['text'] : "" : ""}}'
					id='Anecdote-sticker' class='label label-danger solid-rank dark-knight eng-tips' style='background-color:lightpink '  data-title='Anecdote' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Anecdote-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Anecdote-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Anecdote-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Anecdote-show-button'>Show All </button>
					"> Anecdote </small>

					<small data-Anthropomorphism-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(15,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[15]['text'] : "" : ""}}'
						id='Anthropomorphism-sticker' class='label label-danger solid-rank eng-tips' style='background-color:green '  data-title='Anthropomorphism' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Anthropomorphism-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Anthropomorphism-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Anthropomorphism-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Anthropomorphism-show-button'>Show All </button>
					"> Anthropomorphism </small><br>

					<small data-Antithesis-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(16,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[16]['text'] : "" : ""}}'
					 id='Antithesis-sticker' class='label label-danger solid-rank eng-tips' style='background-color:wine '  data-title='Antithesis' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Antithesis-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Antithesis-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Antithesis-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Antithesis-show-button'>Show All </button>
					"> Antithesis </small>

					<small data-Assonance-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(17,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[17]['text'] : "" : ""}}'
					id='Assonance-sticker' class='label label-danger solid-rank eng-tips ' style='background-color:ash '  data-title='Assonance' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Assonance-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Assonance-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Assonance-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Assonance-show-button'>Show All </button>
					"> Assonance </small><br>

					<small data-Characterisation-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(18,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[19]['text'] : "" : ""}}'
					id='characterisation-sticker' class='label label-danger solid-rank eng-tips' style='background-color:purple '  data-title='Characterisation' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Characterisation-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Characterisation-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Characterisation-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Characterisation-show-button'>Show All </button>
					"> characterisation </small>

					<small data-Euphony-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(19,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[19]['text'] : "" : ""}}'
					id='Euphony-sticker' class='label label-danger solid-rank eng-tips' style='background-color:grey '  data-title='Euphony' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Euphony-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Euphony-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Euphony-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Euphony-show-button'>Show All </button>
					"> Euphony </small><br>

					<small data-Flashback-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(20,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[20]['text'] : "" : ""}}'
					id='Flashback-sticker' class='label label-danger solid-rank eng-tips' style='background-color:green'  data-title='Flashback' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Flashback-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Flashback-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Flashback-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Flashback-show-button'>Show All </button>
					"> Flashback </small>

					<small data-Hyperbaton-sticker=
					'{{Session::has("DeviceBag") ? array_key_exists(21,Session::get("DeviceBag")->devices) ? Session::get("DeviceBag")->devices[21]['text'] : "" : ""}}'
					id='Hyperbaton-sticker' class='label label-danger solid-rank dark-knight eng-tips' style='background-color:yellow '  data-title='Hyperbaton' data-toggle='popover' data-placement='top' data-html='true' data-content="
						<textarea class='form-control popover-width' rows='3' id='Hyperbaton-box'></textarea>
						<button class='btn btn-primary btn-xs' id='Hyperbaton-add-button'><span class='glyphicon glyphicon-plus'></span> </button>
						<button class='btn btn-default btn-xs' style='display:none' id='Hyperbaton-save-button'>save </button>
						<button class='btn btn-success btn-xs pink-panther' id='Hyperbaton-show-button'>Show All </button>
					"> Hyperbaton </small>

				</div>
			</div>
		</div>
	</div>
	{{-- SKELETON MODAL --}}
	<div class='modal fade' id='skeleton-modal'>
		<div class='modal-dialog modal-md'>
			<div class='modal-content'>
				<div class='modal-header'>
					<button class='close pull-right' aria-hidden='true' data-dismiss='modal'>x</button>
					<h4 id='skeleton-title'> Title </h4>
				</div>
				<div class='modal-body'>
					<p id='skeleton-body'>You haven't started your piece, <b>{{Session::get('username')}}</b></p>
				</div>
				<div class='modal-footer'>
				</div>

			</div>
		</div>
	</div>
	{{-- DEVICES MODAL --}}
	<div class='modal fade' id='device-modal'>
		<div class='modal-dialog modal-md'>
			<div class='modal-content'>
				<div class='modal-header'>
				 	<h4> Title <button class='close pull-right' aria-hidden='true' data-dismiss='modal'>x</button></h4>
				</div>
				<div class='modal-body' style='max-height:400px; overflow-y:scroll' id='modal-body'>
					@if(Session::has('DeviceBag'))
						<p>Devices that have been used.
						@foreach (Session::get('DeviceBag')->devices as $device)
							<hr>
							@php
								switch ($device['name']) {
									case 'Metaphor':

										echo "<h3 class='label label-warning solid-rank'>".$device['name']."</h3><br><br>";
										break;
									case 'Simile':
										echo "<h3 class='label label-primary solid-rank'>".$device['name']."</h3><br><br>";
										break;
									case 'Pun':
										echo "<h3 class='label label-danger solid-rank'>".$device['name']."</h3><br><br>";
										break;
									case 'Proverb':
										echo "<h3 class='label label-default solid-rank' style='background-color: ; color: ;' >".$device['name']."</h3><br><br>";
										break;
									case 'Alliteration':
										echo "<h3 class='label label-success solid-rank' style='background-color: ; color: ;' >".$device['name']."</h3><br><br>";
										break;
									case 'Allegory':
										echo "<h3 class='label label-warning solid-rank pink-panther' style='background-color: ; color: ;' >".$device['name']."</h3><br><br>";
										break;
									case 'Euphemism':
										echo "<h3 class='label label-warning solid-rank ' style='background-color:blue ; color: ;' >".$device['name']."</h3><br><br>";
										break;
									case 'Foreshadowing':
										echo "<h3 class='label label-warning solid-rank' style='background-color: cyan; color: ;' >".$device['name']."</h3><br><br>";
										break;
									case 'Imagery':
										echo "<h3 class='label label-warning solid-rank' style='background-color: lime; color: black;' >".$device['name']."</h3><br><br>";
										break;
									case 'Personification':
										echo "<h3 class='label label-warning solid-rank' style='background-color: red; color: white;' >".$device['name']."</h3><br><br>";
										break;
									case 'Epigraph':
										echo "<h3 class='label label-warning solid-rank' style='background-color: orange; color: black;' >".$device['name']."</h3><br><br>";
										break;
									case 'Hyperbole':
										echo "<h3 class='label label-warning solid-rank' style='background-color: black; color: white;' >".$device['name']."</h3><br><br>";
										break;
									case 'Idiom':
										echo "<h3 class='label label-warning solid-rank' style='background-color: white; color:black ;' >".$device['name']."</h3><br><br>";
										break;
									case 'Anecdote':
										echo "<h3 class='label label-warning solid-rank' style='background-color: lightpink; color: black;' >".$device['name']."</h3><br><br>";
										break;
									case 'Anthropomorphism':
										echo "<h3 class='label label-warning solid-rank' style='background-color: green ; ' >".$device['name']."</h3><br><br>";
										break;
									case 'Antithesis':
										echo "<h3 class='label label-warning solid-rank' style='background-color: wine ; color: black;' >".$device['name']."</h3><br><br>";
										break;
									case 'Assonance':
										echo "<h3 class='label label-warning solid-rank' style='background-color: ash; ' >".$device['name']."</h3><br><br>";
										break;
									case 'Characterisation':
										echo "<h3 class='label label-warning solid-rank' style='background-color: purple; color: ;' >".$device['name']."</h3><br><br>";
										break;
									case 'Euphony':
										echo "<h3 class='label label-warning solid-rank' style='background-color:gray ; color: ;' >".$device['name']."</h3><br><br>";
										break;
									case 'Flashback':
										echo "<h3 class='label label-warning solid-rank' style='background-color:green ; color: ;' >".$device['name']."</h3><br><br>";
										break;
									case 'Hyperbaton':
										echo "<h3 class='label label-warning solid-rank' style='background-color: yellow ; color:black ;' >".$device['name']."</h3><br><br>";
										break;
									default:
										# code...
										break;
								}
								$number = 0;
							@endphp
							@foreach ( explode(':'.$device['name'].'-mark'.':', $device['text'] ) as $deviceText)
								@php
									$numberMe = $number+1;
									echo "<p> ".$numberMe.". ".$deviceText." <button type='button' data-device-mother ='".$device['name']."' data-device-motherID='".lookForMother($device['name'])."' data-childID='".$number."' class='btn btn-default btn-xs children'><span class='glyphicon glyphicon-minus'></span></button></p>";
									$number = $number +1;
								@endphp
							@endforeach

						@endforeach
					@else
						<p class='text-center'> You have not included any device in your piece. </p>
					@endif
					@php
						function lookForMother($motherName){
							switch ($motherName) {
								case 'Metaphor':
									return 1;
									break;
								case 'Simile':
									return 2;
									break;
								case 'Pun':
									return 3;
									break;
								case 'Proverb':
									return 4;
									break;
								case 'Alliteration':
									return 5;
									break;
								case 'Allegory':
									return 6;
									break;
								case 'Euphemism':
									return 7;
									break;
								case 'Foreshadowing':
									return 8;
									break;
								case 'Imagery':
									return 9;
									break;
								case 'Personification':
									return 10;
									break;
								case 'Epigraph':
									return 11;
									break;
								case 'Hyperbole':
									return 12;
									break;
								case 'Idiom':
									return 13;
									break;
								case 'Anecdote':
									return 14;
									break;
								case 'Anthropomorphism':
									return 15;
									break;
								case 'Antithesis':
									return 16;
									break;
								case 'Assonance':
									return 17;
									break;
								case 'Characterisation':
									return 18;
									break;
								case 'Euphony':
									return 19;
									break;
								case 'Flashback':
									return 20;
									break;
								case 'Hyperbaton':
									return 21;
									break;

								default:
									break;
							}
						}
					@endphp
				</div>
			</div>
		</div>
	</div>


	<script>
		var token = '{{csrf_field()}}';

		function submitForm(action)
		{
			document.getElementById('pieceForm').action = action ;
			document.getElementById('pieceForm').submit();
		}

		@if(Session::has('revamp'))
			$('#revampButton').on('click',function(event){
				event.preventDefault();
				submitForm('/save-revamped/'+revID);

			});
		@endif
	</script>

@endsection
@section('scripts')
	<script src="{{ asset('js/Newpiece.js') }}"></script>
@endsection
