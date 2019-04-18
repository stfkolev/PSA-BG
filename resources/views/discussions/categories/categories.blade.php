<div class="col-md-4">
        <h3>Categories</h3>

        <div class="list-group">
            <a href="/discussions" class="list-group-item list-group-item-action">All</a>
            @foreach($categories as $category)
                <a href="/discussions/{{ $category->id }}" class="list-group-item list-group-item-action {{ $category->id == $currentCategory ? 'active' : '' }}">
                   {{ $category->name }}
                </a>
            @endforeach
        </div>
</div>