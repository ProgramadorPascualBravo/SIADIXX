<div class="medium-12 cell">
    <label for="name">Nombre<input class="@error('name') is-invalid-input @enderror" type="text" name="name" id="name" wire:model.defer="name"></label>
    @error('name')
    <span class="form-error is-visible">{{ $message }}</span>
    @enderror

    <label for="code">Code<input class="@error('code') is-invalid-input @enderror" type="text" name="code" id="code" wire:model.defer="code"></label>
    @error('code')
    <span class="form-error is-visible">{{ $message }}</span>
    @enderror

    <div class="medium-12 cell">
        <label for="program_id">Curso
            <select class="@error('course_id') is-invalid-input @enderror" name="course_id" id="course_id" wire:model.defer="course_id">
                <option value="">Seleccione una opción</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
            @error('course_id')
            <span class="form-error is-visible">{{ $message }}</span>
        @enderror
    </div>

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
