<?php

namespace Encore\Admin\ManagePlan;

use Encore\Admin\Admin;
use Encore\Admin\Extension;
use Illuminate\Console\Scheduling\CallbackEvent;
use Illuminate\Support\Str;

use Gerardojbaez\Laraplans\Models\Plan;
use Gerardojbaez\Laraplans\Models\PlanFeature;

use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class ManagePlan extends Extension
{
     /**
     * Bootstrap this package.
     *
     * @return void
     */
    public static function boot()
    {
        static::registerRoutes();
        Admin::extend('manageplan', __CLASS__);
    }
  
    protected static function registerRoutes()
    {
        parent::routes(function ($router) {
            /* @var \Illuminate\Routing\Router $router */
            $router->get('manageplan', 'Encore\Admin\Scheduling\SchedulingController@index')->name('scheduling-index');
            $router->post('manageplan/create', 'Encore\Admin\Scheduling\SchedulingController@runEvent')->name('create-plan');
        });
      

    }
  
  
   public function getPlans()
   {
        return $plans;
   }
  
    
   public function CreatePlan($data)
   {
       $plan = Plan::create([
          'name'              => $data['name'],
          'description'       => $data['description'],
          'price'             => $data['price'],
          'interval'          => $data['name'],
          'interval_count'    => $data['interval_count'],
          'trial_period_days' => $data['trial_period_days'],
          'sort_order'        => $data['sort_order'],
      ]);

      if( isset($data['features']) ){
       
        foreach($data['features']  as $feature){
          $features[] = new PlanFeature(['code' => $feature['name'], 'value' => $feature['value'] ]);
        }
        
        $plan->features()->saveMany($features);
      }
   }
  
}