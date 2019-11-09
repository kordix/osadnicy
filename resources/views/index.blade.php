@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{route('edit')}}"><button>Edytuj</button></a>
<div class="row" style="margin-bottom:20px">
    <div class="col-md-3">Drewno: {{$user[0]->wood}} factor: {{$user[0]->woodfactor}}</div>
    <div class="col-md-2">Kamień: {{$user[0]->stone}}</div>
    <div class="col-md-2">Żelazo: {{$user[0]->iron}}</div>
    <div class="col-md-2">
        {{$time}}
    </div>
</div>
<div class="row">
<div class="col-md-2">
    <form action="{{route('update')}}" method="POST">
    {{csrf_field()}}
    {{method_field('PUT')}}
    {{-- <label for="wood">Wood</label> --}}
    {{-- <input type="text" name="wood" type="number"> --}}
    <input type="hidden" name="woodfactor" type="number" value="0.1">

    <button class="btn btn-primary" type="submit">refresh</button>
    </form>
</div>

<div class="col-md-2">
    <form action="{{route('reset')}}" method="POST">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <button class="btn btn-primary" type="submit">reset</button>
    </form>
</div>


</div>

@{{test}}




</div>

@endsection
