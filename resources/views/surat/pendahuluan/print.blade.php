{{-- @extends('layouts.app')
@section('content')
{{ $data->nim }}
{{ $data->tujuan }}
@endsection --}}
<html>
    <body>
        <iframe src="{{ url('pendahuluan/'.$data->files->file) }}" align="top" height="720" width="100%" frameborder="0" scrolling="auto"></iframe>
    </body>
</html>
