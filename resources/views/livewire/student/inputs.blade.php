<div>
    <div class="medium-12 cell">
        <label for="name">Nombres<input class="@error('name') is-invalid-input @enderror" type="text" name="name" id="name" wire:model.defer="name"></label>
        @error('name')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="last_name">Apellidos<input class="@error('last_name') is-invalid-input @enderror" type="text" name="last_name" id="last_name" wire:model.defer="last_name"></label>
        @error('last_name')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="username">Email<input class="@error('email') is-invalid-input @enderror" type="text" name="email" id="email" wire:model.defer="email"></label>
        @error('username')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="document">document<input class="@error('document') is-invalid-input @enderror" type="text" name="document" id="document" wire:model.defer="document"></label>
        @error('document')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="country">country<input class="@error('country') is-invalid-input @enderror" type="text" name="country" id="country" wire:model.defer="country"></label>
        @error('country')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="department">department<input class="@error('department') is-invalid-input @enderror" type="text" name="department" id="department" wire:model.defer="department"></label>
        @error('department')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="city">city<input class="@error('last_name') is-invalid-input @enderror" type="text" name="city" id="city" wire:model.defer="city"></label>
        @error('city')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="last_name">address<input class="@error('address') is-invalid-input @enderror" type="text" name="address" id="address" wire:model.defer="address"></label>
        @error('address')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="telephone">telephone<input class="@error('telephone') is-invalid-input @enderror" type="number" name="telephone" id="telephone" wire:model.defer="telephone"></label>
        @error('telephone')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <div class="medium-12 cell">
        <label for="cellphone">cellphone<input class="@error('cellphone') is-invalid-input @enderror" type="number" name="cellphone" id="cellphone" wire:model.defer="cellphone"></label>
        @error('cellphone')
        <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
    <!--<div class="medium-12 cell">
        <label for="department_id">Departamento
            <select class="@error('department_id') is-invalid-input @enderror" name="department_id" id="department_id" wire:model.defer="department_id">
                <option value="">Seleccione una opción</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            @error('department_id')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>-->
    <div class="medium-12 cell">
        <label for="state">Estado
            <select class="@error('state') is-invalid-input @enderror" name="state" id="state" wire:model.defer="state">
                <option value="">Seleccione una opción</option>
                <option value="1">Activo</option>
                <option value="0">Desactivado</option>
            </select>
            @error('state')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>
</div>
