<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Form::component('textLabel','component.form.textview',['name','value','label','attributes']);
        Form::component('textAreaLabel','component.form.csTextBox',['name','value','label','attributes']);
        Form::component('datePickerLabel','component.form.csDatePicker',['name','value','label','attributes']);
        Form::component('selectLabel','component.form.csDropdown',['name','options','value','label','attributes' => []]);
        Form::component('buttonLabel','component.form.csButton',['name','attributes']);
    }
}
