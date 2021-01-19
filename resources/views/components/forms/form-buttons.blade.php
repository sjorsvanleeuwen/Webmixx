<div class="form-group">
    @if($show_cancel)
        <a href="{{ $cancelUrl }}" class="btn btn-secondary">Cancel</a>
    @endif
    @if($show_save && $show_save_and_continue)
        <div class="btn-group" role="group">
            <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
            <button type="submit" name="save" value="save_continue" class="btn btn-primary">Save and Continue</button>
        </div>
    @elseif($show_save)
        <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
    @elseif($show_save_and_continue)
            <button type="submit" name="save" value="save_continue" class="btn btn-primary">Save and Continue</button>
    @endif
</div>
