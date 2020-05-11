<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/all_courses', 'UserController@allCourses');




Auth::routes();
//Route::get('/home', 'HomeController@indextest');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('submit_attendance','AttendanceController@submitAttendance');

/*Student*/
Route::get('/enrollModule/{mod_id}', 'UserController@enrollModule');
Route::get('/enrollSeminar/{sem_id}', 'UserController@enrollSeminar');
Route::get('/enrollStudy/{std_id}', 'UserController@enrollStudy');
Route::post('/submit_modules_attendance', 'AttendanceController@moduleAttendance');
Route::get('/viewModuleAttendance/{module_id}/{std_id}','ModuleController@moduleAttendance');
Route::get('/modules','ModuleController@index');
Route::get('/seminars','SeminarController@index');
Route::get('/study_groups','StudyGroupController@index');
Route::get('/viewSeminarAttendance/{module_id}/{std_id}','SeminarController@seminarAttendance');
Route::post('/submit_seminars_attendance', 'AttendanceController@seminarAttendance');
Route::get('/viewStudyAttendance/{study_id}/{std_id}','StudyGroupController@studyAttendance');

/*Common*/

Route::get('/user_profile','UserController@userProfile');
Route::post('/update_profile','UserController@update');

/*Admin */
Route::get('/modules_settings','ModuleController@modulesSettings');
Route::post('/create_module','ModuleController@createModule');
Route::get('/seminars_settings','SeminarController@seminarSettings');
Route::post('/create_seminar','SeminarController@createSeminar');
Route::get('/manager_module_sheet','ModuleController@managerModule');
Route::get('/search_mod_sheet','AttendanceSheetController@searchModSheet');
Route::get('/manager_seminar_sheet','SeminarController@managerSeminar');
Route::get('/search_sem_sheet','AttendanceSheetController@searchSemSheet');
Route::get('/manager_study_group_sheet','StudyGroupController@managerStudy');
Route::get('/search_study_sheet','AttendanceSheetController@searchStudySheet');

Route::get('/study_groups_settings','StudyGroupController@studyGroupSettings');
Route::post('/create_study','StudyGroupController@createGroup');

/*Lecturer*/
Route::get('/module_atd_sheet','ModuleController@moduleAtdSheet');
Route::post('/create_module_sheet','AttendanceSheetController@createModuleSheet');
Route::get('/active_module_sheet/{id}','AttendanceSheetController@activeModuleSheet');
Route::get('/deactive_module_sheet/{id}','AttendanceSheetController@deactiveModuleSheet');
Route::get('/viewModuleSheet/{id}','AttendanceSheetController@viewModuleSheet');
Route::get('/seminar_atd_sheet','SeminarController@seminarAtdSheet');
Route::post('/create_seminar_sheet','AttendanceSheetController@createSeminarSheet');
Route::get('/active_seminar_sheet/{id}','AttendanceSheetController@activeSeminarSheet');
Route::get('/deactive_seminar_sheet/{id}','AttendanceSheetController@deactiveSeminarSheet');
Route::get('/viewSeminarSheet/{id}','AttendanceSheetController@viewSeminarSheet');
Route::get('/study_group_atd_sheet','StudyGroupController@studyAtdSheet');
Route::post('/create_study_sheet','AttendanceSheetController@createStudySheet');
Route::get('/active_study_sheet/{id}','AttendanceSheetController@activeStudySheet');
Route::get('/deactive_study_sheet/{id}','AttendanceSheetController@deactiveStudySheet');
Route::get('/viewStudySheet/{id}','AttendanceSheetController@viewStudySheet');
/*Absent Present */
Route::get('/module_present/{id}','AttendanceController@modulePresent');
Route::get('/module_absent/{id}','AttendanceController@moduleAbsent');
Route::get('/seminar_present/{id}','AttendanceController@seminarPresent');
Route::get('/seminar_absent/{id}','AttendanceController@seminarAbsent');
Route::get('/study_present/{id}','AttendanceController@studyrPresent');
Route::get('/study_absent/{id}','AttendanceController@setudyAbsent');

