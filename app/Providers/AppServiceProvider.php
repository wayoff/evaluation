<?php

namespace App\Providers;

use App\Form;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('welcome', function ($view) {
            $today = Carbon::now();
            $forms = collect();

            if (!auth()->guest() && auth()->user()->user_type == 'student') {
                $user = auth()->user();
                $answers = auth()->user()->answers;
                $professors = $user->student->professors;

                foreach($professors as $prof) {
                    $evaluations = $prof->evaluations()->whereHas('form', function($query) use($today) {
                        $query->where('start_date', '<=', $today)->where('end_date', '>', $today);
                    })->get();

                    foreach($evaluations as $evaluation) {
                        $exists = $answers->where('evaluation_id', $evaluation->id)->first();

                        $array = $evaluation->form->toArray();
                        $array['name'] = $prof->name;
                        $array['professor_id'] = $prof->id;
                        $array['evaluation_id'] = $evaluation->id;
                        $array['exists'] = !empty($exists) ? true : false;

                        $forms->push($array);
                    }
                }
            } else {
                $forms = Form::where('start_date', '<=', $today)->where('end_date', '>', $today)->get()->toArray();
            }

            $view->with('forms', $forms);
        });
    }
}
