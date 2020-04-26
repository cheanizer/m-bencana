<div class="control-group">
    {!! Form::label($name,$label,['class' => 'control-label'])!!}
    <div class="controls">
        @php
         $class = 'datepicker';
         if ($attributes['class'])
         {
             $class .= ' ' . $attributes['class'];
             unset ($attributes['class']);
         }
        @endphp
        {!! Form::text($name,$value, array_merge(['class' => $class, $attributes]))!!}
        @error($name)
        <span class="help-inline text-error">{{ $message }}</span>
        @enderror
    </div>
</div>
