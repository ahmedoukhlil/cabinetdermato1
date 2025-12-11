<tr data-index="{{ $index }}">
    <td>
        <select class="form-control select2 categorie_sale" name="sale_details[{{ $index }}][categorie_id]" id="sale_details_{{ $index }}_categorie_id" required>
            @foreach($categories as $id => $categorie)
            <option value="{{ $id }}" {{ old('sale_details.'. $index .'.categorie_id') == $id ? 'selected' : '' }}>{{ $categorie }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="form-control select2 artice_sale" name="sale_details[{{ $index }}][article_id]" id="sale_details_{{ $index }}_article_id" required>
            @foreach($articles as $id => $article)
            <option value="{{ $id }}" {{ old('sale_details.'. $index .'.article_id') == $id ? 'selected' : '' }}>{{ $article }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input class="form-control quantitySale" type="number" name="sale_details[{{ $index }}][quantity]" id="sale_details_{{ $index }}_quantity" value="{{ old('sale_details.'. $index .'.quantity', 0) }}" step="1" required>
    </td>
    <td>
        <input class="form-control" type="number" name="sale_details[{{ $index }}][prix_unitaire]" id="sale_details_{{ $index }}_prix_unitaire" value="{{ old('sale_details.'. $index .'.prix_unitaire', 1) }}" step="1" required readonly>
    </td>
    <td>
        <input class="form-control" type="number" name="sale_details[{{ $index }}][montant_total]" id="sale_details_{{ $index }}_montant_total" value="{{ old('sale_details.'. $index .'.montant_total', 0) }}" step="1" readonly>
    </td>
    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('global.delete')</a>
    </td>
</tr>
