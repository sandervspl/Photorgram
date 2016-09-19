{!! Form::label('category', 'Category*', ['class' => 'col-sm-2 control-label']) !!}
<div class="col-sm-2">
    {!! Form::select(
            'category',
            [
                '1' => 'Nature',
                '2' => 'Comics',
                '3' => 'Funny',
                '4' => 'Meme',
                '5' => 'Portrait',
                '6' => 'People',
                '7' => 'Animal'
            ],
            null,
            [
                'class'       => 'form control input-sm',
                'placeholder' => 'Pick a category...',
                'required'    => 'required'
            ]
        )
    !!}
</div>