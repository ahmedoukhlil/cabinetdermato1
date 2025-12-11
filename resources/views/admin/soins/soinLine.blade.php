<tr data-index="{{ $index }}">
    <td>
        <select class="form-control select2 type_soin" name="soin_details[{{ $index }}][type_id]" id="soin_details_{{ $index }}_type_id" required>
            @foreach($types as $id => $type)
            <option value="{{ $id }}" {{ old('soin_details.'. $index .'.type_id') == $id ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input class="form-control quatitySoin" type="number" name="soin_details[{{ $index }}][quantity]" id="soin_details_{{ $index }}_quantity" value="{{ old('soin_details.'. $index .'.quantity', 0) }}" step="1" required>
    </td>
    <td>
        <input class="form-control" type="number" name="soin_details[{{ $index }}][prix_unitaire]" id="soin_details_{{ $index }}_prix_unitaire" value="{{ old('soin_details.'. $index .'.prix_unitaire', 1) }}" step="1" required readonly>
    </td>
    <td>
        <input class="form-control" type="number" name="soin_details[{{ $index }}][prix_total]" id="soin_details_{{ $index }}_prix_total" value="{{ old('soin_details.'. $index .'.prix_total', 1) }}" step="1" readonly>
    </td>
    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('global.delete')</a>
    </td>
</tr>
