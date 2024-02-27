@extends('layouts.app')
@section('content')

    @if (session('dataToUpdate'))
        @php
            $data = session('dataToUpdate')[0];
            $checkCategory = explode(',', $data->categories);
            $selectedCast = explode(',', $data->cast_crew);
        @endphp
        {{-- {{ explode(',',$data->cast_crew)[0] }} --}}
        @include('layouts.form')
    @else
        @include('layouts.form')
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('success_massage'))
        @component('alert')
            {{ Session::get('success_massage') }}
        @endcomponent
    @elseif(Session::has('error_massage'))
        @component('alert')
            <strong>Whoops!</strong> {{ Session::get('error_massage') }}
        @endcomponent
    @endif

    <div class="container mt-5 mb-3 d-block p-3 table-responsive border rounded-2">
        @include('layouts.tableView')
    </div>
    
@endsection
