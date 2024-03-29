@extends('layouts.app')
@section('content')
    <form class="container border rounded-2 my-3 p-3" id="myForm" action="/cast" method="POST">
        {{ csrf_field() }}
        <div class="mb-3">
            <label for="cast" class="input-lable p-2">Cast</label>
            <input type="text" class="form-control" id="cast" name="cast" required>
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <button id="castAdd" name="submit" type="submit" class="btn btn-dark mx-2">Save</button>
            <a href="/home" class="btn btn-dark mx-2">Go Back</a>
        </div>
    </form>
    
    @if (Session::has('success_massage'))
        @component('alert')
        {{ Session::get('success_massage') }}
        @endcomponent
    @elseif(Session::has('error_massage'))
        @component('alert')
            <strong>Whoops!</strong> {{ Session::get('error_massage') }}
        @endcomponent
    @endif
    
@endsection
