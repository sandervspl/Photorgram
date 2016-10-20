<?php
if (isset($image)) {
    $cur_category = $image->category_id;
} else {
    $cur_category = null;
}
?>
<div class="col-sm-3">
    <select name="category" class="form-control input-sm" required>
        @foreach($categories as $category)
            @if ($category->id == $cur_category)
                <option value="{{ $category->id }}" selected=>
                    {{ ucfirst(trans($category->name)) }}
                </option>
            @else
                <option value="{{ $category->id }}">
                    {{ ucfirst(trans($category->name)) }}
                </option>
            @endif
        @endforeach
    </select>
</div>