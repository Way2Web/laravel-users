@if($errors->count())
    <ul class="alert alert-danger">
        <h4><strong>Whoops!</strong> There were some problems with your input.</h4>
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </ul>
@endif