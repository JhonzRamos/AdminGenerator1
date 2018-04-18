@extends('admin.layouts.master')

@section('content')

    <form action="#" method="POST">
        <div class="fb-autocomplete form-group field-autocomplete-1523887326373"><label for="autocomplete-1523887326373"
                                                                                        class="fb-autocomplete-label">Autocomplete</label><input
                    class="form-control" id="autocomplete-1523887326373-input" autocomplete="off"><input
                    class="form-control" name="autocomplete-1523887326373" id="autocomplete-1523887326373"
                    type="hidden">
            <ul id="autocomplete-1523887326373-list" class="fb-autocomplete-list">
                <li value="option-1">Option 1</li>
                <li value="option-2">Option 2</li>
                <li value="option-3">Option 3</li>
                <li value="undefined"></li>
            </ul>
        </div>
    </form>
@endsection