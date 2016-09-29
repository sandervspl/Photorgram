<?php

if (isset($image)) {
    $category = $image->category_id;
} else {
    $category = null;
}

?>
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
                '7' => 'Animal',
                '8' => 'City',
                '9' => 'Art'
            ],
            $category,
            [
                'class'       => 'form control input-sm',
                'placeholder' => 'Pick a category...',
                'required'    => 'required'
            ]
        )
    !!}
</div>