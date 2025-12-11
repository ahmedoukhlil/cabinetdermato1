<tr data-index="{{ $index }}">
    <td><input class="form-control"                  type="text" name="paiement_details[{{ $index }}][facture_id]" id="paiement_details[{{ $index }}][facture_id]"  value="{{old('paiement_details.'.$index.'.facture_id', isset($field) ? $field->id:0)}}" readonly></td>
    <td><input class="form-control mnt_encaissement" type="text" name="paiement_details[{{ $index }}][montant]"         id="paiement_details[{{ $index }}][montant]"          value="{{old('paiement_details.'.$index.'.montant', 0)}}" required></td>
    <td><input class="form-control"                  type="text" name="paiement_details[{{ $index }}][montant_restant]" id="paiement_details[{{ $index }}][montant_restant]"  value="{{old('paiement_details.'.$index.'.montant_restant', isset($field) ? ($field->montant-$field->montant_encaisse):0)}}" readonly></td>
    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('global.delete')</a>
    </td>
</tr>