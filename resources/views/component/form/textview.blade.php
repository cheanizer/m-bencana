<div class="control-group">
    {!! Form::label($name,$label,['class' => 'control-label'])!!}
    <div class="controls">
        {!! Form::text($name,$value, $attributes)!!}
        @error($name)
        <span class="help-inline text-error">{{ $message }}</span>
        @enderror
    </div>
</div>
