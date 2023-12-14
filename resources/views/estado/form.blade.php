
<div class="box box-info padding-1" >
    <div class="box-body" style="padding: 15px;">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('name', $estado->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-success">{{ __('Guardar') }}</button>
    </div>
</div>

