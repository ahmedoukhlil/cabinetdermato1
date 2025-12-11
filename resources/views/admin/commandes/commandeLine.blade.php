<tr data-index="{{ $index }}">
    <td>
        <select class="form-control select2 categorie_commande" name="commande_details[{{ $index }}][categorie_id]" id="commande_details_{{ $index }}_categorie_id" required>
            @foreach($categories as $id => $categorie)
            <option value="{{ $id }}" {{ old('categorie_id') == $id ? 'selected' : '' }}>{{ $categorie }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="form-control select2 " name="commande_details[{{ $index }}][article_id]" id="commande_details_{{ $index }}_article_id" required>
            @foreach($articles as $id => $article)
            <option value="{{ $id }}" {{ old('article_id') == $id ? 'selected' : '' }}>{{ $article }}</option>
            @endforeach
        </select>
    </td>
    <td>

        <input class="form-control commande_dets commande_qtt" type="number" name="commande_details[{{ $index }}][quantity]" id="commande_details_{{ $index }}_quantity" value="{{ old('quantity', '') }}" step="1" required>
    </td>
    <td>
        <input class="form-control commande_dets" type="number" name="commande_details[{{ $index }}][prix_unitaire]" id="commande_details_{{ $index }}_prix_unitaire" value="{{ old('prix_unitaire', '') }}" step="1">
    </td>
    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('global.delete')</a>
    </td>
</tr>
