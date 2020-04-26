<div class="control-group">
    {!! Form::label($name,$label,['class' => 'control-label'])!!}
    <div class="controls">
        {!! Form::select($name,$options,$value,$attributes)!!}
        @error($name)
        <span class="help-inline text-error">{{ $message }}</span>
        @enderror
    </div>
</div>
