{{-- @extends('home') --}}
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Cast & Crew</th>
            <th scope="col">Rating</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody id="tableBody" class="table-group-divider">
        @php
            $i = 1;
        @endphp

        @foreach ($movies as $movie)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $movie->movie_name }}</td>
                <td>{{ $movie->categories }}</td>
                <td>{{ $movie->cast_crew }}</td>
                <td>{{ $movie->rating }}</td>
                <td><a class="btn btn-dark editBtn" href="/home/{{ $movie->id }}"><span
                            class="material-symbols-outlined">edit_square</span></a></td>
                <td><button class="btn btn-dark deleteBtn" data-id = "{{ $movie->id }}"><span
                            class="material-symbols-outlined">delete</span></button></td>
            </tr>
        @endforeach

    </tbody>
</table>
