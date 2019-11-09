@extends('layouts.app')

@section('content')
    <div class="container">
<form action="{{route('update')}}" method="POST">
{{csrf_field()}}
{{method_field('PUT')}}
{{-- <label for="wood">Wood</label> --}}
{{-- <input type="text" name="wood" type="number"> --}}
{{$time}}
<label for="wood">Wood factor</label>
<input type="text" name="woodfactor" type="number">

<button class="btn btn-primary" type="submit">refresh</button>
</form>
</div>
@endsection
