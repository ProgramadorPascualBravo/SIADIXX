<?php

namespace App\Charts;

use App\Enrollment;
use App\Traits\Months;
use Arr;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;
use DB;

class EnrollmentChartMake extends Chart
{
    use Months;

    /**
     * Initializes the chart.
     *
     * @return void
     */

    protected $enrollments          = Enrollment::class;

    public function __construct()
    {
        parent::__construct();
    }

    public function getEnrollmentsForState($state)
    {
      $enrollments = $this->enrollments::query()->where('state', $state)->orderBy('created_at')->get()->groupBy(function($item) {
         return $item->created_at->format('m');
      })->map(function ($item) {
         return count($item);
      });
      $organized = $this->organizeDataByMonth($enrollments);

      return $organized;
    }

   public function getAllEnrollments()
   {
      $enrollments = $this->enrollments::query()->orderBy('created_at')->get()->groupBy(function($item) {
         return $item->created_at->format('m');
      })->map(function ($item) {
         return count($item);
      });
      $organized = $this->organizeDataByMonth($enrollments);

      return $organized;
   }

   public function getEnrollmentMonthCurrentForState()
   {
      $enrollments = $this->enrollments::query()->select('state', DB::raw('count(*) as total'))
         ->whereMonth('created_at', Carbon::now()->month)
         ->groupBy('state')->get();

      $data = collect();
      foreach ($enrollments as $key => $enrollment)
      {
         $data->put($enrollment->state, $enrollment->total);
      }

      return $data;
   }

}
