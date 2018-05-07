<?php
namespace Encore\Admin\ManagePlan;

use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

class ManagePlanController
{
  
  /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
          
            $content->header('Manage Plans');
            $manageplan = new ManagePlan();
          
            $content->body(view('laravel-admin-extension-laraplans::index', [
                'events' => $manageplan->getPlans(),
            ]));
        });
    }
    
    public create(Request $request)
    {
        $manageplan = new ManagePlan();
      
        $data = new array();
      
        $data['name']               = $request->get('name');
        $data['description']        = $request->get('description');
        $data['price']              = $request->get('price');
        $data['interval']           = $request->get('interval');
        $data['interval_count']     = $request->get('interval_count');
        $data['trial_period_days']  = $request->get('trial_period_days');
        $data['sort_order']         = $request->get('sort_order');
              
         try {
            $output = $scheduling->CreatePlan($data);
            return [
                    'status'    => true,
                    'message'   => 'success',
                    'data'      => $output,
                  ];
        } catch (\Exception $e) {
            return [
                    'status'    => false,
                    'message'   => 'failed',
                    'data'      => $e->getMessage(),
                   ];
        }
    }
  
}