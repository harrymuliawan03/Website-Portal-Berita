<?php

namespace App\Charts;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyTrafficViews
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($requestCategory, $requestyear): \ArielMejiaDev\LarapexCharts\LineChart
    {
        if($requestCategory == null) {
            $traffic = [];
        }else{
            $category = Category::where('category_name', $requestCategory)->pluck('id')->toArray();
            $traffic = [];
            for($i = 1 ; $i <= 12; $i++){
                    if($requestyear != null ) {
                        $traffic[] = (int)Post::where('user_id', auth()->user()->id)->where('category_id', $category)->whereMonth('created_at', $i)->whereYear('created_at', $requestyear)->sum('traffic');
                    }else{
                        $traffic[] = (int)Post::where('user_id', auth()->user()->id)->where('category_id', $category)->whereMonth('created_at', $i)->sum('traffic');
                    }
            }
        }
        return $this->chart->lineChart()
            ->setTitle('Views Traffic In ' . date('Y'))
            ->setSubtitle('Category')
            ->addData('Views', $traffic)
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
    }
}