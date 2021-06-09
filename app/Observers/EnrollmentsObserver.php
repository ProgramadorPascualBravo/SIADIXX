<?php

namespace App\Observers;

use App\Enrollment;
use App\EnrollmentMoodle;
use App\StateEnrollment;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\False_;

/**
 * Componente https://laravel.com/docs/7.x/eloquent#observers
 * Class EnrollmentsObserver
 * @package App\Observers
 */
class EnrollmentsObserver
{

    /**
     * Handle the enrollment "created" event.
     *
     * @param  \App\Enrollment  $enrollment
     * @return void
     */
    public function created(Enrollment $enrollment)
    {
       if (!StateEnrollment::find($enrollment->state)->delete_moodle) {
          $enrollment->enrollment_moodle()->create([
             'email'             => $enrollment->email,
             'code'              => $enrollment->code,
             'rol'               => $enrollment->rol,
          ]);
       }
    }

    /**
     * Handle the enrollment "updated" event.
     *
     * @param  \App\Enrollment  $enrollment
     * @return void
     */
    public function updated(Enrollment $enrollment)
    {
       if ($enrollment->isDirty('state')) {
          if (StateEnrollment::find($enrollment->state)->delete_moodle) {
             $enrollment->enrollment_moodle()->delete();
          } else {
             EnrollmentMoodle::firstOrCreate([
                'email'             => $enrollment->email,
                'code'              => $enrollment->code,
                'rol'               => $enrollment->rol,
                'enrollment_id'     => $enrollment->id
             ]);
          }
       }

    }

    /**
     * Handle the enrollment "deleted" event.
     *
     * @param  \App\Enrollment  $enrollment
     * @return void
     */
    public function deleted(Enrollment $enrollment)
    {
       $enrollment_moodle = EnrollmentMoodle::where('enrollment_id', $enrollment->id)->first();
       $enrollment_moodle->delete();

    }

    /**
     * Handle the enrollment "restored" event.
     *
     * @param  \App\Enrollment  $enrollment
     * @return void
     */
    public function restored(Enrollment $enrollment)
    {
        //
    }

    /**
     * Handle the enrollment "force deleted" event.
     *
     * @param  \App\Enrollment  $enrollment
     * @return void
     */
    public function forceDeleted(Enrollment $enrollment)
    {
        //
    }
}
