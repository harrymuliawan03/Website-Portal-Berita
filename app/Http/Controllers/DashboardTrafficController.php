<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\MonthlyTrafficViews;
use App\Models\Category;

class DashboardTrafficController extends Controller
{
    public function index(MonthlyTrafficViews $monthlyTrafficViews) 
    {
            $categoryOld = request('category');
            $yearOld = request('year');

            
            $data['categories']     = Category::all()->pluck('category_name')->toArray();
            $data['categoryOld']    = $categoryOld; 
            $data['yearOld']        = $yearOld; 
            $data['breadCrumb']     = 'Traffic Views';
            $data['dataTraffic']    = $monthlyTrafficViews->build(request('category'), request('year'));
            
            return view('dashboard.traffic.index', $data);
        
    }
}