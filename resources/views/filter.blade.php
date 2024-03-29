@extends('layouts.app')
@section('content')
    <div class="container-md p-3">
        <div class="row justify-content-evenly">
            <div class="col-md-4 my-3 border rounded p-2">
                <div class="d-flex flex-column p-2">
                    <h4 class="p-2 " id="basic-addon1">Filters</h4>


                    <div class="mb-2 border-bottom" id="radioForSort">
                        <h6 class="p-2 " id="basic-addon1">Sorting</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sortingOrder" id="ascending" value="asc"
                                checked>
                            <label class="form-check-label" for="ascending">
                                A-Z
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sortingOrder" id="descending"
                                value="desc">
                            <label class="form-check-label" for="descending">
                                Z-A
                            </label>
                        </div>
                    </div>


                    <div class="mb-2 border-bottom pb-3">
                        <h6 class="p-2 " id="basic-addon1">Category</h6>
                        <select class="form-select cast-crew-select" name="castAndCrew[]" id="selectCategories" style="width: 100%;" multiple="multiple" required>
                            @foreach ($categories as $category)
                                {{ $category->category }}
                                <option value="{{ trim($category->category) }}">
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-2 border-bottom">
                        <h6 class="p-2 " id="basic-addon1">Rating</h6>
                        <div class="form-check">
                            <input class="form-check-input checkInput" type="checkbox" name="rating[]" value="1"
                                id="rating1">
                            <label class="form-check-label" for="rating1">1</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkInput" type="checkbox" name="rating[]" value="2"
                                id="rating2">
                            <label class="form-check-label" for="rating2">2</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkInput" type="checkbox" name="rating[]" value="3"
                                id="rating3">
                            <label class="form-check-label" for="rating3">3</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkInput" type="checkbox" name="rating[]" value="4"
                                id="rating4">
                            <label class="form-check-label" for="rating4">4</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkInput" type="checkbox" name="rating[]" value="5"
                                id="rating5">
                            <label class="form-check-label" for="rating5">5</label>
                        </div>
                    </div>

                    <button class="btn btn-dark" id="submit">Submit</button>
                </div>


            </div>
            <div class="col-md-7 my-3  table-responsive border rounded-2 p-2">
                <table class="table  table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Cast & Crew</th>
                            <th scope="col">Rating</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="table-group-divider">
                        @foreach ($data as $movie)
                            <tr>
                                <td>{{ $movie->movie_name }}</td>
                                <td>{{ $movie->categories }}</td>
                                <td>{{ $movie->cast_crew }}</td>
                                <td>{{ $movie->rating }}</td>
                            </tr>
                        @endforeach
                    </tbody>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/report_main.js') }}"></script>
@endsection
