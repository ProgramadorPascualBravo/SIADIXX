<?php
// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('dashboard',  function (BreadcrumbTrail  $trail) {
   $trail->push('Inicio', route('dashboard'));
});

Breadcrumbs::for('users', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Usuarios', route('user-index'));
});

Breadcrumbs::for('user-detail', function (BreadcrumbTrail $trail, $user) {
   $trail->parent('users');
   $trail->push($user->full_name, route('user-detail', $user->id));
});

Breadcrumbs::for('students', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Us Moodle', route('student-index'));
});

Breadcrumbs::for('student-mass-creation', function (BreadcrumbTrail $trail){
   $trail->parent('students');
   $trail->push('Creación masiva', route('student-mass-creation'));
});

Breadcrumbs::for('students-detail', function (BreadcrumbTrail $trail, $student) {
   $trail->parent('students');
   $trail->push($student->full_name, route('student-detail', $student->id));
});

Breadcrumbs::for('role', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Roles', route('role-index'));
});

Breadcrumbs::for('permission', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Permisos', route('permission-index'));
});

Breadcrumbs::for('category', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Categorias', route('department-index'));
});

Breadcrumbs::for('program', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Programas', route('program-index'));
});

Breadcrumbs::for('program-detail', function (BreadcrumbTrail $trail, $program) {
   $trail->parent('program');
   $trail->push($program->name, route('program-detail', $program->id));
});

Breadcrumbs::for('course', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Asignaturas', route('course-index'));
});

Breadcrumbs::for('course-not-dashboard', function (BreadcrumbTrail  $trail){
   $trail->push('Asignaturas', route('course-index'));
});

Breadcrumbs::for('course-detail', function (BreadcrumbTrail $trail, $course) {
   $trail->parent('program');
   $trail->push($course->program->name, route('program-detail', $course->program_id));
   $trail->parent('course-not-dashboard');
   $trail->push($course->name, route('course-detail', $course->id));
});

Breadcrumbs::for('group', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Grupos', route('group-index'));
});

Breadcrumbs::for('group-not-dashboard', function (BreadcrumbTrail  $trail){
   $trail->push('Grupo', route('group-index'));
});

Breadcrumbs::for('group-detail', function (BreadcrumbTrail $trail, $group) {
   $trail->parent('program');
   $trail->push($group->course->program->name, route('program-detail', $group->course->program_id));
   $trail->parent('course-not-dashboard');
   $trail->push($group->course->name, route('course-detail', $group->course->id));
   $trail->push('Grupo: '. $group->name, route('group-detail', $group->id));
});

Breadcrumbs::for('role_moodle', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Roles Moodle', route('role-moodle-index'));
});

Breadcrumbs::for('enrollment', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Matrículas', route('enrollment-index'));
});

Breadcrumbs::for('search', function (BreadcrumbTrail  $trail){
   $trail->parent('dashboard');
   $trail->push('Búsqueda', route('search-index'));
});