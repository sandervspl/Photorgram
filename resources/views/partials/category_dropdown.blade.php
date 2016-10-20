<div class="filter-category-container">
    <div class="dropdown">
        <button class="button button-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Filter Category
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="{{ action('ImageController@allImages') }}">All</a></li>
            <li class="divider"></li>
            @foreach($categories as $category)
                <li>
                    <a href="{{ action('ImageController@category', ['categoryid' => $category->name]) }}">
                        {{ ucfirst(trans($category->name)) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>