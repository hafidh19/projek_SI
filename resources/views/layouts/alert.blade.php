@if(session('success'))
    <div class="alert alert-success">
    <a class="panel-close close" data-dismiss="alert">×</a>
        {{ session('success')}}
    </div>
@endif

@if(session('danger'))
    <div class="alert alert-danger">
    <a class="panel-close close" data-dismiss="alert">×</a>
        {{ session('danger')}}
    </div>
@endif