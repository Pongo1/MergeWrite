@extends('layouts.app')

@section('content')
        <div style='margin-top:70px;'></div>
        <div class='container'>
            <div class='row'>
                <div class='col-md-10 col-md-offset-1'>
                    @if(Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    <div class='panel panel-warning solid-two '>
                        <div class='panel-heading panther' style='background:#b36b00; color:white;'>
                            @if(Session::has('selectedBook'))
                                <h1 class='panel-title solid-text-light'><span class='glyphicon glyphicon-book'></span> {{Session::get('selectedBook')->Title}}<small class='pull-right fontlize'>Book started: {{ Session::get('selectedBook')->created_at->diffForHumans()}}</small>
                                </h1>
                            @endif
                        </div>
                        <div class='panel-body cute-page-view'>
                            <center>
                                <h2 class='solid-text-light dark-knight'>{{Session::get('chapter')->chapter_title}} <span class='dark-knight'><h3> {{$page->page_title}} </h3></span> </h2>
                                <div>{{$page->body}}</div>
                            </center>
                        </div>
                        <div class='footer clearfix' style='padding:4px;'>
                            <a style='opacity:0'>ss</a>
                            <a class='btn btn-default btn-sm solid-two-light solid-text-light-two'><span class='glyphicon glyphicon-backward'></span></a>
                            <a class='btn btn-default btn-sm solid-two-light solid-text-light-two'><span class='glyphicon glyphicon-forward'></span></a>
                            <a href='{{route('book.view',Session::get('bookId'))}}' class='btn btn-primary btn-sm solid-two-light solid-text-light-two'> Back </a>

                                {{-- EDIT AND DELETE ON THE FAR RIGHT --}}
                            <a class='pull-right' style='opacity:0'>ss</a>
                            <a class='btn btn-danger btn-sm pull-right solid-two-light solid-text-light-two' data-toggle='modal' data-target='#deletePage'><span class='glyphicon glyphicon-trash'></span> Delete</a>
                            <p class='pull-right' style='opacity:0'>s</p>
                            <a class='btn btn-primary btn-sm pull-right solid-two-light solid-text-light-two' data-toggle='modal' data-target='#Page-Content'><span class='glyphicon glyphicon-edit'></span> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- EDIT PAGE CONTENT MODAL --}}
        <form action='{{route('page.edit',$page->id)}}' method='get'>
            <div class="modal fade" id='{{ 'Page-Content' }}'>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
                            <h4 class='modal-title solid-text-light-two dark-knight'>Edit Page Content</h4>
                        </div>
                        <form action= "" method="get">
                            <div class='modal-body'>
                                <div class='form-group'>
                                    <br>
                                        <label for='' class='dark-knight'>Title of page:</label>
                                        <input type='name' class='form-control'  value="{{$page->page_title}}" name='title'>
                                    <label for='' class='dark-knight'>Page content:</label>
                                    <textarea rows='8' class='form-control' name='page_body' placeholder=''>{{$page->body}}</textarea>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button class='btn btn-primary solid-two-light solid-text-light-two' type='submit'><span class='glyphicon glyphicon-save'></span> Save</button>
                                <button class='btn btn-warning solid-two-light solid-text-light-two' type='button' data-dismiss='modal'>Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>


        {{-- DELETE CONFIRMATION MODAL --}}
        <div class='modal fade' id='deletePage'>
    		<div class='modal-dialog modal-sm'>
    			<div class='modal-content'>
    				<div class='modal-header'>
    					<button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
    					<h3 class='modal-title'>Delete Page</h3>
    				</div>
    				<div class='modal-body'>
    					<small>Are you sure you want to delete this page?</small>
    				</div>
    				<div class='modal-footer'>

						<a href="{{route('page.delete',$page->id)}}" class="btn btn-danger btn-sm solid-two-light"  type='submit'><i class="glyphicon glyphicon-trash"></i> Yes</a>


    				</div>
    			</div>
    		</div>
    	</div>

@endsection
