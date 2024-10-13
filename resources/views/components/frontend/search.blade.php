<form method="POST" method="POST" action="{{ route('searchProcess') }}">
    @csrf
    <div class="row row-space">
        <div class="col-2">
            <div class="input-group">
                <input class="input--style-2"
                       type="text"
                       placeholder=" Valid NID Number *"
                       minlength="10"
                       max="16"
                       name="nid"
                       value="{{ old('nid') }}"
                       required >
            </div>
            @error('nid')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="p-t-30">
        <button class="btn btn--radius btn--green" type="submit">Search</button>
    </div>
</form>
