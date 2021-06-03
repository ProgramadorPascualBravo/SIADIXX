<?php

namespace App\Http\Controllers;

use App\Charts\CourseChartMake;
use App\Charts\EnrollmentChartMakeMake;
use App\Charts\StudentMoodleChartMake;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Highcharts\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Str;

class PageController extends Controller
{

    public function index()
    {

        return view('index');
    }

    public function singin(Request $request)
    {
        $request->validate([
            'username' => 'required|email:rfc|exists:users,username,state,1',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        return redirect(route('login'))->withErrors(['failed' => 'Estas credenciales no coinciden con nuestros registros. ']);
    }

    public function logout ()
    {
        Auth::logout();
        Session::flush();
        return redirect(route('login'));
    }

    public function verify($code)
    {
       $user = User::where('confirmation_code', $code)->first();
       if (! is_null($user)) {
         $user->email_verified_at = Carbon::now('America/Bogota')->toDateTimeString();
         $user->verified = 1;
         $user->save();
         Auth::login($user);
         return redirect()->intended('dashboard');
       }
       return view('email_verified.error');
    }

    public function reportStudent()
    {

       $chart_total = StudentMoodleChartMake::newChart();
       $chart_total->title(Str::ucfirst('Total de '.__('modules.moodle.name')));
       $chart_total->labels(["Total", "Mes"]);
       $chart_total->options(collect([
          'chart' => [
             'plotBackgroundColor' => null,
             'plotBorderWidth' => null,
             'plotShadow' => false,
             'type' => 'pie',
          ],
          'plotOptions' => [
             'pie' => [
                'allowPointSelect' => true,
                'cursor' => 'pointer',
                'dataLabels' => [
                   'enabled'=> true,
                   'format' => "<b>{point.name}</b>: {point.percentage:.1f} %"
                ],
             ],
          ],
          'series' => [
             [
                'name' =>  'Matrículas',
                'colorByPoint' => true,
                'data' => [
                   [
                      'name' => 'Total',
                      'y' => $chart_total->getTotal(),
                   ], [
                      'name' => 'Mes',
                      'y' => $chart_total->getMonthCurrent()
                   ]
                ]
             ]
          ]
       ]));
       $chart_total->dataset(Str::ucfirst('total'), 'pie', [$chart_total->getTotal()]);

       $chart_state = StudentMoodleChartMake::newChart();
       $chart_state->label('Cantidad');
       $chart_state->title('Usuarios creados por mes del año '. now()->year);
       $chart_state->labels($chart_state->getMonths());
       $chart_state->dataset(Str::title(__('modules.moodle.name')), 'column', $chart_state->getAllStudentForMonthForState()->values());
       return view('report.student', ['chartstate' => $chart_state, 'charttotal' => $chart_total]);
    }

    public function reportEnrollment()
    {
       $chart_total = EnrollmentChartMakeMake::newChart();
       $chart_total->title(Str::ucfirst('Total de '.__('modules.enrollment.name')));
       $chart_total->labels(["Total", "Mes"]);
       $chart_total->options(collect([
          'chart' => [
             'plotBackgroundColor' => null,
             'plotBorderWidth' => null,
             'plotShadow' => false,
             'type' => 'pie',
          ],
          'plotOptions' => [
             'pie' => [
                'allowPointSelect' => true,
                'cursor' => 'pointer',
                'dataLabels' => [
                   'enabled'=> true,
                   'format' => "<b>{point.name}</b>: {point.percentage:.1f} %"
                ],
             ],
          ],
          'series' => [
             [
                'name' =>  'Matrículas',
                'colorByPoint' => true,
                'data' => [
                   [
                      'name' => 'Total',
                      'y' => $chart_total->getTotal(),
                   ], [
                      'name' => 'Mes',
                      'y' => $chart_total->getMonthCurrent()
                   ]
                ]
             ]
          ]
       ]));
       $chart_total->dataset(Str::ucfirst('total'), 'pie', [$chart_total->getTotal()]);


       $chart_state = EnrollmentChartMakeMake::newChart();
       $chart_state->label('# Matrículas');
       $chart_state->labels($chart_state->getMonths());
       $chart_state->dataset(Str::title(__('modules.enrollment.name')), 'area', $chart_state->getAllEnrollmentsForYear()->values());
       foreach (['Desmatriculado', 'Matrículado', 'Cancelada', 'Finalizada', 'Retirado'] as $state) {
          $chart_state->dataset(Str::title($state), 'column', $chart_state->getEnrollmentsForState($state)->values());
       }
       return view('report.enrollment', ['chartstate' => $chart_state, 'charttotal' => $chart_total]);
    }

    public function reportCourse()
    {
       $chart_groups = CourseChartMake::newChart();

       $chart_groups->label('Cantidad');
       $chart_groups->title(Str::ucfirst(__('Grupos por asignatura')));
       $chart_groups->labels($chart_groups->getGroupsForCourse()->keys());
       $chart_groups->dataset(__('modules.course.name'), 'column', $chart_groups->getGroupsForCourse()->values());

       /***/
       $chart_total = CourseChartMake::newChart();
       $chart_total->title(Str::ucfirst('Total de '.__('modules.course.name')));
       $chart_total->label('cantidad');
       $chart_total->labels(["Total", "Mes"]);
       $chart_total->options(collect([
          'chart' => [
             'plotBackgroundColor' => null,
             'plotBorderWidth' => null,
             'plotShadow' => false,
             'type' => 'pie',
          ],
          'plotOptions' => [
            'pie' => [
               'allowPointSelect' => true,
               'cursor' => 'pointer',
               'dataLabels' => [
                  'enabled'=> true,
                  'format' => "<b>{point.name}</b>: {point.percentage:.1f} %"
               ],
            ],
          ],
          'series' => [
             [
               'name' =>  'Asignaturas',
               'colorByPoint' => true,
               'data' => [
                  [
                     'name' => 'Total',
                     'y' => $chart_total->getTotal(),
                  ], [
                     'name' => 'Mes',
                     'y' => $chart_total->getMonthCurrent()
                  ]
               ]
             ]
          ]
        ]));
       $chart_total->dataset(Str::ucfirst('total'), 'pie', [$chart_total->getTotal()]);

       /**/

       $chart_year = CourseChartMake::newChart();
       $chart_year->title( Str::ucfirst(__('modules.course.pname') .' creadas por mes del año '.now()->year));
       $chart_year->label('Cantidad');
       $chart_year->labels($chart_year->getMonths());
       $chart_year->dataset(Str::ucfirst('Total'), 'area', $chart_year->getAllForYear()->values());

       /**/

       $chart_enrollment = CourseChartMake::newChart();
       $chart_enrollment->title('Matrículas totales y activas por asignatura');
       $course_enrollment = $chart_enrollment->getEnrollmentsForCourse();
       $chart_enrollment->labels($course_enrollment->keys());
       $m = [];
       $t = [];
       foreach ($course_enrollment->keys() as $course) {
          array_push($t, $course_enrollment->get($course)[1]);
          array_push($m, $course_enrollment->get($course)[0]);
       }
       $chart_enrollment->dataset('total', 'column', $t);
       $chart_enrollment->dataset('matrículados', 'column', $m);

       return view('report.course', [
          'chartgroups'       => $chart_groups,
          'charttotal'        => $chart_total,
          'chartyear'         => $chart_year,
          'chartenrollment'   => $chart_enrollment
       ]);
    }
}
