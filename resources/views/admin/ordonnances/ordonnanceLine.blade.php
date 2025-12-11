<tr data-index="{{ $index }}">
    <td>
        <select class="form-control select2 getArticleList" name="ordonnance_details[{{ $index }}][category_id]" id="ordonnance_details{{ $index }}category_id" required>
            @foreach($categories as $id => $category)
            <option value="{{ $id }}" {{ old('ordonnance_details.'.$index.'.category_id', isset($field) ? $field->category_id: '') == $id ? 'selected' : '' }}>{{ $category }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="form-control select2 getArticleList" name="ordonnance_details[{{ $index }}][forme_id]" id="ordonnance_details{{ $index }}forme_id" required>
            @foreach($formes as $id => $forme)
            <option value="{{ $id }}" {{ old('ordonnance_details.'.$index.'.forme_id', isset($field) ? $field->forme_id: '') == $id ? 'selected' : '' }}>{{ $forme }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="form-control select2" name="ordonnance_details[{{ $index }}][article_id]" id="ordonnance_details{{ $index }}article_id" required>
            @foreach($articles as $id => $article)
            <option value="{{ $id }}" {{ old('ordonnance_details.'.$index.'.article_id', isset($field) ? $field->article_id: '') == $id ? 'selected' : '' }}>{{ $article }}</option>
            @endforeach
        </select>
    </td>
    <td><input class="form-control" type="text" name="ordonnance_details[{{ $index }}][posologie]" id="ordonnance_details[{{ $index }}][posologie]" value="{{old('ordonnance_details.'.$index.'.posologie', isset($field) ? $field->posologie: '')}}" required></td>
    <td><input class="form-control" type="number" name="ordonnance_details[{{ $index }}][quantity]" id="ordonnance_details[{{ $index }}][quantity]" value="{{old('ordonnance_details.'.$index.'.quantity', isset($field) ? $field->quantity: '')}}" required></td>
    <td><input class="form-control" type="text" name="ordonnance_details[{{ $index }}][duration]" id="ordonnance_details[{{ $index }}][duration]" value="{{old('ordonnance_details.'.$index.'.duration', isset($field) ? $field->duration: '')}}" required></td>
    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('global.delete')</a>
    </td>
</tr>