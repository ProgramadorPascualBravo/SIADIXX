<?php

namespace App\View\Components;

use App\Course;
use App\Enrollment;
use App\Group;
use App\Program;
use App\Student;
use App\Traits\Months;
use App\User;
use Illuminate\View\Component;

class StatsCurrentMonthComponent extends Component
{
    use Months;

    public $title;

    public $eloquent;

    protected $data = [
       'user' => [
         'title' => 'Usuario monitor',
         'class' => User::class
       ],
       'moodle' => [
          'title' => 'Usuario moodle',
          'class' => Student::class
       ],
       'program' => [
          'title' => 'Programas',
          'class' => Program::class
       ],
       'course' => [
          'title' => 'Asignaturas',
          'class' => Course::class
       ],
       'group' => [
          'title' => 'Grupos',
          'class' => Group::class
       ],
       'enrollment' => [
          'title' => 'Matrículas',
          'class' => Enrollment::class
       ],
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->title       = $this->data[$type]['title'];
        $this->eloquent    = $this->data[$type]['class'];
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.stats-current-month');
    }

}
