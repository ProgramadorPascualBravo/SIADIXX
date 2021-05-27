<?php

namespace App\Charts;

use App\Student;
use App\Traits\Months;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

class UserMoodleChartMake extends Chart
{
    use Months;

   protected $student          = Student::class;


   /**
     * Initializes the chart.
     *
     * @return void
     */

   public function __construct()
   {
      parent::__construct();
   }

   public function getAllStudent()
   {
      return Student::all()->count();
   }
   public function getAllStudentForMonth()
   {
      $students = $this->student::query()->orderBy('created_at')->get()->groupBy(function($item) {
         return $item->created_at->format('m');
      })->map(function ($item) {
         return count($item);
      });
      $organized = $this->organizeDataByMonth($students);

      return $organized;
   }

   public function getEnrollmentMonthCurrent()
   {
      $total = $this->student::query()
         ->whereMonth('created_at', Carbon::now()->month)
         ->get()->count();
      return $total;
     // return $data;
   }
}
