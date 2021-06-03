<?php

namespace App\Charts;

use App\Student;
use App\Traits\Months;
use Carbon\Carbon;

class StudentMoodleChartMake extends BaseChartMake
{

   protected $model          = Student::class;


   /**
     * Initializes the chart.
     *
     * @return void
     */

   public function __construct()
   {
      parent::__construct();
   }


   public function getAllStudentForYear(): \Illuminate\Support\Collection
   {
      return $this->getAllForYear();
   }

   public function getAllStudentForMonthForState(int $state = 1): \Illuminate\Support\Collection
   {
      return $this->getForState($state);
   }

   public function getEnrollmentMonthCurrent()
   {
      return $this->getMonthCurrent();
   }
}