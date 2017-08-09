@extends("layouts.app")

@section("content")
    <div style="margin-top:60px;"></div>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-4 col-md-4'>
                @if(Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
                    {{-- SHOW CHAPTERS --}}
                <div class='panel panel-warning solid-two '>
                    <div class='panel-heading panther' style='background:#b36b00; color:white;'>
                        <h1 class='panel-title solid-text-light'><span class="glyphicon glyphicon-book"></span> {{ count(str_split($foundBook->Title)) >18 ? substr($foundBook->Title,0,12).'...' : $foundBook->Title  }}
                        <a type='button' data-toggle='modal' data-target='{{ '#Book-deletion-'.$foundBook->id }}' class='btn btn-danger btn-xs solid-text-light-two'>
                           <span class='glyphicon glyphicon-trash'>
                           </span>
                       </a>
                       <!-- edit-name button for Book -->
                       <a type='button' data-toggle='modal' data-target='{{ '#Book-name-edit-'.$foundBook->id }}' class='btn btn-primary btn-xs  solid-text-light-two'>
                          <span class='glyphicon glyphicon-edit'>
                          </span>
                      </a>
                       <small class='pull-right fontlize'>Book started: {{$foundBook->created_at->diffForHumans()}}</small></h1>
                    </div>
                    <div class='panel-body cute-page-view ' >
                        <center>
                            <p class='dark-knight solid-text-light-two'>Chapters in {{$foundBook->Title}} <span class='badge'>{{count($foundBook->chapters)}}</span></p>
                        </center>
                        <a class='btn btn-success solid-two-light' data-toggle='modal' data-target='#Chapter-Name' style='width:100%; margin-bottom:7px;'><span class='glyphicon glyphicon-plus'></span> New Chapter</a>
                        @foreach($foundBook->chapters as $bookChapter )
                            <a href='/chapter-view/{{ $foundBook->id}}/{{$bookChapter->id}}'  class='btn btn-default solid-two-light' style='width:100%; margin-bottom:7px;'>{{$bookChapter->chapter_title}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>{{-- End of cols but still in row --}}
                                                            {{-- DISPLAY CHAPTER SUMMARY AND PAGES --}}
            <div class='col-lg-8 col-md-8'>
                <div class='panel panel-info solid-two cute-side-page'>
                    <div class='panel-heading' style='background:#cc7a00; color:white'>
                        @if(Session::has('chapter'))
                            @if(Session::get('chapter')->book_id == $foundBook->id )
                                <h1 class='panel-title solid-text-light'>{{ Session::get('chapter')->chapter_title }}
                                     <a type='button' data-toggle='modal' data-target='{{ '#Chapter-delete-'.Session::get('chapter')->id }}' class='btn btn-danger btn-xs  solid-text-light-two'>
                                        <span class='glyphicon glyphicon-trash'>
                                        </span>
                                    </a>

                                    <!-- edit button for chapter -->
                                    <a type='button' data-toggle='modal' data-target='{{ '#Chapter-name-edit-'.Session::get('chapter')->id }}' class='btn btn-primary  solid-text-light btn-xs'><span class='glyphicon glyphicon-edit'></span></a>

                                    <small class='pull-right fontlize'> {{count(Session::get('chapter')->pages)==1 ? count(Session::get('chapter')->pages).' page' : count(Session::get('chapter')->pages).' pages'}} </small>
                                </h1>
                            @else
                                <h1 class='panel-title solid-text-light'>No chapter selected.
                                    <small class='pull-right fontlize'> 0 pages </small>
                                </h1>
                            @endif
                        @else
                            <h1 class='panel-title solid-text-light'>No chapter selected.
                                <small class='pull-right fontlize'> 0 pages </small>
                            </h1>
                        @endif
                    </div>

                    <div class='panel-body'>
                        <center>
                            @if(Session::has('chapter'))
                                @if(Session::get('chapter')->book_id == $foundBook->id )
                                    <h3 class='solid-text-light dark-knight'>{{Session::get('chapter')->chapter_title}}<br>
                                        <a href='{{route('page.make')}}' class='btn btn-default btn-xs solid-two-light solid-text-light'>
                                            <span class='glyphicon glyphicon-plus'></span> Add page
                                        </a>
                                    </h3>
                                    <p class='dark-knight'>{{Session::get('chapter')->short_intro}}
                                    </p>
                                    <hr class='intro-light'>

                                </center>

                                    @if(count(Session::get('chapter')->pages) != 0)
                                        @foreach(Session::get('chapter')->pages as $page)
                                            <div class='col-lg-4 col-md-4'>
                                                <div style='overflow-x:hidden;' class='thumbnail clearfix cute-page solid-two-light'>
                                                    <center>
                                                        <p class='dark-knight solid-text-light-two'><b>{{ $page->page_title}}</b></p>
                                                        <small>{{substr($page->body,0,40)."..."}}</small><br>
                                                        <a href='{{route('page.show',$page->id)}}' class='solid-two-light btn btn-primary btn-xs solid-text-light-two'>View <span class='glyphicon glyphicon-eye-open'></span></a>
                                                    </center>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class='alert alert-info solid-two-light solid-text-light-two'>
                                            No page yet!
                                        </p>
                                    @endif

                            @else
                                <div class='alert alert-info  solid-two-light'>
                                    <p class='solid-text-light-two'>No chapter summary or pages available for chapter!</p>
                                </div>
                            @endif
                        @else
                            <div class='alert alert-info solid-two-light '>
                                <p class='solid-text-light-two'>No chapter summary or pages available for chapter!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

        {{-- NEW CHAPTER MODAL --}}
        <div class='modal fade' id='Chapter-Name'>
            <div class='modal-dialog modal-md'>
                <div class='modal-content'>
                  <div class='modal-header'>
                      <h4 class='solid-text-light-two' style='color:black'><span style='color:green' class=' glyphicon glyphicon-plus'></span> <b>New Chapter </b><button data-dismiss='modal' aria-hidden="true" class='close pull-right'>x</button></h4>
                  </div>
                  <form method='get' action='{{route('chapter.create',$foundBook->id)}}' style='color:black'>
                        <div class='modal-body'>
                          <small>You are about to create a new chapter in ...... What title should your chapter have <b>{{ Session::get('username')}}</b>?</small>
                          <br>
                          <br>
                              <div class='form-group'>
                                  <input class='form-control' name='chapter_name' placeholder="Chapter title" required><br>

                                  <textarea rows='5' name='chapter_description' class='form-control'  placeholder="Short description of what is to happen in this chapter --optional"></textarea>
                                  <input type='hidden' value='{{ $foundBook->id}}'name='book_id'>

                              </div>
                        </div>
                          <div class='modal-footer'>
                              <div class='form-group'>

                                  <button class='btn btn-danger solid-two-light btn-sm solid-text-light-two'  data-dismiss='modal'>Cancel</button>
                                  <input type='submit' name='send_chapter_title' style='background:orange; color:white' value='create' class='btn btn-warning solid-text-light-two btn-sm solid-two-light'>
                              </div>
                         </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>

        <!-- CHAPTER DELETE CONFIRMATION -->
        @if(Session::has('chapter'))
            <div class='modal fade' id='{{ 'Chapter-delete-'.Session::get('chapter')->id }}'>
                <div class='modal-dialog modal-sm'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
                            <h4 class='modal-title'>Delete Chapter</h4>
                        </div>
                        <div class='modal-body'>
                            <small>{{ Session::get('username') }}! are you sure you want to delete <b>{{ Session::get('chapter')->chapter_title}}</b> from  <b>{{ $foundBook->Title }}? </b></small>
                        </div>
                        <div class='modal-footer'>
                             <a href="{{ route('chapter.delete',Session::get('chapter')->id)}}" class="btn btn-danger pull-right solid-two solid-text-light-two">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- EDIT CHAPTER NAME -->
        @if(Session::has('chapter'))
            <div class='modal fade' id='{{'Chapter-name-edit-'.Session::get('chapter')->id }}'>
                <div class='modal-dialog modal-md'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
                            <h4 class='modal-title solid-text-light dark-knight'><span class='glyphicon glyphicon-edit'></span> Edit Chapter title</h4>
                        </div>
                        <form action='/chapter-edit/{{$foundBook->id}}/{{Session::get('chapter')->id}}' get='get'>
                            <div class='modal-body'>
                                <small class='solid-text-light-two dark-knight'>You can change the name and chapter summary in your book here!</small><br><br>
                                <div class='form group'>
                                    <input class='form-control' value='{{Session::get('chapter')->chapter_title}}' name='chapter_title'><br>
                                    <textarea class='form-control' rows='6' name='chapter_short_intro'>{{Session::get('chapter')->short_intro}}</textarea>
                                </div>
                            </div>
                        <div class='modal-footer'>
                             <button type='submit' class="btn btn-danger pull-right solid-two">Save</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        @endif

        <!-- EDIT BOOK NAME -->
        <div class='modal fade' id='{{'Book-name-edit-'.$foundBook->id }}'>
            <div class='modal-dialog modal-sm'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
                        <h4 class='modal-title solid-text-light dark-knight'><span class='glyphicon glyphicon-edit'></span> Edit book title</h4>
                    </div>
                    <form action='{{route('bookname.edit',$foundBook->id)}}' get='get'>
                        <div class='modal-body'>
                            <small class='solid-text-light-two dark-knight'>You can change the name of your book here!</small>
                            <div class='form group'>
                                <input class='form-control' value='{{$foundBook->Title}}' name='book_title'>
                            </div>
                        </div>
                    <div class='modal-footer'>
                         <button type='submit' class="btn btn-danger pull-right solid-two solid-text-light-two">Save</button>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <!-- BOOK DELETE CONFIRMATION -->
        <div class='modal fade' id='{{'Book-deletion-'.$foundBook->id }}'>
            <div class='modal-dialog modal-sm'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'></span>&times;<span class="sr-only"></span></button>
                        <h4 class='modal-title'>Delete Book</h4>
                    </div>
                    <div class='modal-body'>
                        <small>{{ Session::get('username') }}! are you sure you want to delete  <b>{{ $foundBook->Title }}? </b>. <Br> You are deleting a whole book. If you press 'yes', everything would be gone and can never be retrieved. <br>If you are certain this is what you want, you may proceed.</small>
                    </div>
                    <div class='modal-footer'>
                         <a href="{{ route('book.delete',$foundBook->id)}}" class="btn btn-danger pull-right solid-two solid-text-light-two">Yes</a>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/merge.js') }}"></script>
@endsection
