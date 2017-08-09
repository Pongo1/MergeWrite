@extends('layouts.app')
@section('content')
    <div style='margin-top:70px'></div>
    <div class='container'>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 col-md-offset-3" id="makePane">
                <div class='thumbnail solid' style="padding:30px; background: #ffe0b3;">
                    <h4 class='modal-title solid-text-light'><b>New Page </b><a href='{{ route('book.view',Session::get('bookId')) }}' class='close pull-right' aria-hidden='true' type='submit'><small class="solid-text-light"><b>x</b></small></a></h4>
                    <form action='{{ route('page.create',Session::get('chapter')->id) }}' method='get'>
                        <div class='form-group clearfix'>
                            <br>
                            <label for='' class="solid-text-light-two">Page Title or Number </label>
                            <input type='name' class='form-control solid-two-light' placeholder='title' name='page_title'>
                            <br>
                            <label for='' class="solid-text-light-two">Content</label>
                            <textarea rows='9' class='form-control solid-two-light clearfix' name='page_body' placeholder='Page Body'></textarea>
                            <hr>
                            <button class='btn btn-success pull-right solid-two-light' type='submit'><span class='glyphicon glyphicon-save'></span> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
