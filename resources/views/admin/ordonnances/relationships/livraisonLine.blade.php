<tr data-index="{{ $index }}">
    <td>
        <select class="form-control select2 categorie_sale" name="livraison[{{ $index }}][categorie_id]" id="livraison_{{ $index }}_categorie_id" required>
            @foreach($categories as $id => $categorie)
            <option value="{{ $id }}" {{ old('livraison.'. $index .'.categorie_id') == $id ? 'selected' : '' }}>{{ $categorie }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="form-control select2 artice_sale" name="livraison[{{ $index }}][article_id]" id="livraison_{{ $index }}_article_id" required>
            @foreach($articles as $id => $article)
            <option value="{{ $id }}" {{ old('livraison.'. $index .'.article_id') == $id ? 'selected' : '' }}>{{ $article }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input class="form-control quantitySale" type="number" name="livraison[{{ $index }}][quantity]" id="livraison_{{ $index }}_quantity" value="{{ old('livraison.'. $index .'.quantity', 1) }}" step="1" required>
    </td>
    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('global.delete')</a>
    </td>
</tr>
