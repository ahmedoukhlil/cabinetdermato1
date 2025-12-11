<tr data-index="{{ $index }}">
    <td>
        <input class="form-control" type="text" name="analyse_details[{{ $index }}][name]" id="analyse_details[{{ $index }}][name]" value="{{ old('analyse_details.'.$index.'.name') }}" size="50" required>
    </td>
    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('global.delete')</a>
    </td>
</tr>