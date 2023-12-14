
<div class="box box-info padding-1">
    <div class="box-body" style="padding: 15px;">
        
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $area->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
    </div>
</div>
