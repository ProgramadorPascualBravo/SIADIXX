<?php

namespace App\Observers;

use App\Enrollment;
use App\EnrollmentMoodle;
use Illuminate\Database\Eloquent\Model;

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
       if ($enrollment->state === 'Matrículado') {
         $enrollment_moodle = new EnrollmentMoodle();
         $enrollment_moodle->create([
             'email'             => $enrollment->email,
             'code'              => $enrollment->code,
             'rol'               => $enrollment->rol,
             'enrollment_id'     => $enrollment->id
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
        if ($enrollment->state === 'Matrículado') {
           $enrollment_moodle = EnrollmentMoodle::where('enrollment_id', $enrollment->id)->first();
           if (is_null($enrollment_moodle)) {
              $enrollment_moodle = new EnrollmentMoodle();
              $enrollment_moodle->create([
                 'email'             => $enrollment->email,
                 'code'              => $enrollment->code,
                 'rol'               => $enrollment->rol,
                 'enrollment_id'     => $enrollment->id
              ]);
           } else {
              $enrollment_moodle->update([
                 'email'             => $enrollment->email,
                 'code'              => $enrollment->code,
                 'rol'               => $enrollment->rol
              ]);
           }
        } else {
           $enrollment_moodle = EnrollmentMoodle::where('enrollment_id', $enrollment->id)->first();
           if (!is_null($enrollment_moodle)) {
              $enrollment_moodle->delete();
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
