<div class="medium-12 cell">
    <label for="name">Nombre<input class="@error('name') is-invalid-input @enderror" type="text" name="name" id="name" wire:model.defer="name"></label>
    @error('name')
        <span class="form-error is-visible">{{ $message }}</span>
    @enderror
</div>
