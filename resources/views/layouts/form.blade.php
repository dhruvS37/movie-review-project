<form class="container border rounded-2 my-3 p-3"  id="myForm" action="/home/@isset($data){{ $data->id }} @endisset"
    method="POST">

    @isset($data) {{ method_field('PUT') }} @endisset
    {{ csrf_field() }}

    <div class="mb-3">
        <label for="movieNameInput" class="input-label p-2">Movie Name</label>
        <input type="text" class="form-control" id="movieNameInput" name="movieName"
            value="@isset($data){{ $data->movie_name }}@endisset" required>
    </div>

    <div class="mb-3">
        <div class="d-flex">
            <div class="input-lable p-2 w-50" id="basic-addon1">Category</div>

            <div class=" w-50 d-flex justify-content-end">
                <a href="/category" id="addCategory" class="btn "><span
                        class="material-symbols-outlined">add_circle</span></a>
            </div>
        </div>

        <div class="row p-2 mx-0 border rounded" id="categoryInput" required>

            @foreach ($categories as $category)
                <div class="form-check col-sm-6 col-md-2">
                    <input class="form-check-input checkInput" type="checkbox" name="category[]"
                        value="{{ $category->category }}" id="{{ $category->id }}"
                        @isset($checkCategory)
                            @if (in_array($category->category, $checkCategory)) {{ 'checked' }} @endif 
                        @endisset >

                    <label class="form-check-label" for="${id}">{{ $category->category }}</label>
                </div>
            @endforeach

        </div>
    </div>

    <div class="mb-3">

        <div class="d-flex">
            <label for="castAndCrewInput" class="input-lable p-2 w-50">Cast & Crew</label>

            <div class="w-50 d-flex justify-content-end">
                <a href="/cast" id="addRating" class="btn">
                    <span class="material-symbols-outlined">add_circle</span></a>
            </div>
        </div>

        <select class="form-select" style="width: 100%;" name="castAndCrew[]" id="castAndCrewInput" multiple="multiple" required>
            @foreach ($casts as $cast)
                <option value="{{ $cast->cast_name }}"
                    @isset($selectedCast)
                        @if (in_array($cast->cast_name, $selectedCast)) {{ 'selected' }} @endif
                    @endisset>
                    {{ $cast->cast_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <div for="ratingInput" class="input-label p-2">Rating</div>
        <select class="form-select" style="width: 100%;" name="rating" id="ratingInput" required>
            <option value=""></option>
            <option value="1" {{ isset($data) && $data->rating == '1' ? 'selected' : '' }}>1</option>
            <option value="2" {{ isset($data) && $data->rating == '2' ? 'selected' : '' }}>2</option>
            <option value="3" {{ isset($data) && $data->rating == '3' ? 'selected' : '' }}>3</option>
            <option value="4" {{ isset($data) && $data->rating == '4' ? 'selected' : '' }}>4</option>
            <option value="5" {{ isset($data) && $data->rating == '5' ? 'selected' : '' }}>5</option>
        </select>
    </div>

    <div class="mb-3 text-center">
        <button id="submit" name="submit" type="submit" class="btn btn-dark mx-2">{{ isset($data) ? "Update" : "Save"}}</button>
        <button id="reset" name="reset" type="reset" class="btn btn-dark mx-2">Reset</button>
    </div>


</form>
