<?php
if (isset($image)) {
    $cur_category = $image->category_id;
} else {
    $cur_category = null;
}
?>
<div class="col-sm-2">
    <select name="category" class="form-control input-sm" required>
        @foreach($categories as $category)
            @if ($category->id == $cur_category)
                <option value="{{ $category->id }}" selected=>{{ $category->name }}</option>
            @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
        @endforeach
    </select>
</div>