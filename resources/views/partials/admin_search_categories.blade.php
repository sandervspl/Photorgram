<div class="admin-search">
    {!! Form::open([
    'action' => 'SearchController@adminSearchCategories'
    ])
    !!}

    {!! Form::text('search', '', ['class' => 'admin-search-field', 'required' => 'required']) !!}

    {!! Form::close() !!}
</div>