<?php

namespace App\Charts;

use App\Enrollment;

class EnrollmentChartMake extends BaseChartMake
{
    /**
     * Initializes the chart.
     *
     * @return void
     */

   protected $model          = Enrollment::class;

   public function __construct()
   {
       parent::__construct();
   }

   public function getEnrollmentsForState($state)
   {
       return $this->getForState($state);
   }

   public function getAllEnrollmentsForYear()
   {
       return $this->getAllForYear();
   }

   public function getEnrollmentMonthCurrent()
   {
       return $this->getMonthCurrent();
   }

}
