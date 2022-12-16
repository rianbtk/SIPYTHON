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

// Python
use App\Http\Controllers\python\ExercisePythonController;
use App\Http\Controllers\python\PythonLearningTopicsController;
use App\Http\Controllers\python\PythonPercobaanController;
use App\Http\Controllers\python\ResultController;



Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'admin']], function() {
  Route::get('/admin', 'AdminController@index');
  Route::resource('/admin/topics', 'TopicController'); 
  Route::resource('/admin/admintasks', 'TaskController');
  Route::resource('/admin/learning', 'LearningFileController');	
  Route::resource('/admin/resources', 'ResourcesController');
  Route::resource('/admin/testfiles', 'TestFilesController');
  Route::get('/admin/testfiles/create/{topic}', 'TestFilesController@create');
  Route::resource('/admin/assignteacher', 'AssignTeacherController');
  Route::resource('/admin/assignteacher/index', 'AssignTeacherController@index');
	Route::resource('/admin/tmember', 'TeacherClassMemberController');
  Route::resource('/admin/studentres', 'StudentValidController');
  Route::get('/admin/studentres/{student}/{id}', 'StudentValidController@showteacher');
  Route::get('/admin/uploadsrc/{student}/{id}', 'StudentValidController@showsource');

  Route::resource('/admin/resview', 'StudentResultViewController');
 Route::resource('/admin/rankview', 'StudentResultRankController');
Route::resource('/admin/completeness', 'StudentCompletenessController');

  Route::get('/admin/uistudentdetail/{student}/{id}', 'UiDetailController@showadmin');
  Route::get('/admin/uiuploadsrc/{student}/{topicid}/{id}', 'UiDetailController@showsource');
  Route::get('/admin/uiresview/{student}/{topicid}', 'UiResultViewController@showhistory');

  Route::resource('/admin/uitopic', 'UiTopicController');
  Route::resource('/admin/uitestfiles', 'UiTestFilesController');
  Route::resource('/admin/uiresview', 'UiResultViewController');
  Route::resource('/admin/uisummaryres', 'UiResultController');
  Route::resource('/admin/exerciseconf', 'ExerciseTopicController');
  Route::resource('/admin/exercisefiles', 'ExerciseFilesController');
  Route::resource('/admin/exerciseresources', 'ExerciseResourcesController');
  Route::resource('/admin/exerciseresview', 'ExerciseResultViewController');
  Route::get('/admin/exercisestudentres/{student}/{id}', 'ExerciseValidController@showadmin');
  Route::get('/admin/exercisestudentres/{student}/{topicid}/{id}', 'ExerciseValidController@showsource');

  Route::resource('/admin/resetpassword', 'ResetPasswordController');

  // Python Topik Tampilan
  Route::get('/admin/python/topic', [PythonLearningTopicsController::class, 'index']);
  Route::get('/admin/python/tambahtopik', [PythonLearningTopicsController::class, 'tambah']);
  Route::get('/admin/python/edittopik/{id_topik}', [PythonLearningTopicsController::class, 'edit']);

  // Python Percobaan Tampilan
  Route::get('/admin/python/percobaan', [PythonPercobaanController::class, 'index']);
  Route::get('/admin/python/tambahpercobaan', [PythonPercobaanController::class, 'tambah']);
  Route::get('/admin/python/editpercobaan/{id_percobaan}', [PythonPercobaanController::class, 'edit']);
  
  // proses tambah + update
  Route::post('/admin/python/prosestambahtopik', [PythonLearningTopicsController::class, 'proses_tambah']);
  Route::post('/admin/python/prosesedittopik/{id_topik}', [PythonLearningTopicsController::class, 'proses_edit']);
  Route::post('/admin/python/prosestambahpercobaan', [PythonPercobaanController::class, 'proses_tambah']);
  Route::post('/admin/python/proseseditpercobaan/{id_percobaan}', [PythonPercobaanController::class, 'proses_edit']);
  
  // proses hapus
  Route::get('/admin/python/proseshapustopik/{id_topik}', [PythonLearningTopicsController::class, 'proses_hapus']);
  Route::get('/admin/python/proseshapuspercobaan/{id_percobaan}', [PythonPercobaanController::class, 'proses_hapus']);



});

Route::group(['middleware' => ['auth', 'teacher']], function() {
  Route::get('/teacher', 'TeacherController@index');
  Route::resource('/teacher/assignstudent', 'AssignStudentController');
  Route::resource('/teacher/member', 'StudentMemberController');
  Route::resource('/teacher/studentclasssummary', 'StudentResultClassController');
  Route::resource('/teacher/studentpassedresult', 'StudentPassedResultClassController');
  Route::resource('/teacher/studentres', 'StudentValidController');
  Route::resource('/teacher/crooms', 'ClassroomController');
  Route::get('/teacher/studentres/{student}/{id}', 'StudentValidController@showteacher');
	Route::get('/teacher/uploadsrc/{student}/{id}', 'StudentValidController@showsource');
 Route::resource('/teacher/rankview', 'StudentResultRankController');
Route::resource('/teacher/jplasdown', 'JplasDownloadController');

  // UI (BARU)
  Route::resource('/teacher/uiclasssummary', 'UiResultClassController');
  Route::resource('/teacher/uiresview', 'UiResultViewController');
  Route::get('/teacher/uiresview/{student}/{topicid}', 'UiResultViewController@showhistory');
  Route::resource('/teacher/uisummaryres', 'UiResultController');
  Route::get('/teacher/uistudentres/{student}/{id}', 'UiValidController@showadmin');
  Route::get('/teacher/uiuploadsrc/{student}/{topicid}/{id}', 'UiValidController@showsource');

Route::resource('/teacher/completeness', 'StudentCompletenessController');

// Python
  //tampilan result mahasiswa dari dosen
  Route::get('teacher/python/resultstudent', [ResultController::class, 'student_submit']);
  Route::get('teacher/python/resultstudentdetail/{id_topik}/{id_percobaan}', [ResultController::class, 'detail']);

});

Route::group(['middleware' => ['auth', 'student']], function() {
  Route::get('/student', 'StudentController@index');
  Route::resource('/student/tasks', 'TaskStdController');
  Route::resource('/student/results', 'TaskResultController');
//  Route::get('/student/results/valsub', 'TaskResultController@valsub');
Route::patch('/student/results/valsub',['as' => 'results.valsub', 'uses' => 'TaskResultController@valsub']);
  Route::get('student/results/create/{topic}', 'TaskResultController@create');
  Route::resource('/student/lfiles', 'FileResultController');
  Route::get('student/lfiles/create/{topic}', 'FileResultController@create');
  Route::get('student/lfiles/valid/{topic}', 'FileResultController@submit');
 Route::get('student/lfiles/delete/{id}/{topic}', 'FileResultController@delete');
 Route::resource('/student/rankview', 'StudentResultRankController');
  Route::resource('/student/valid', 'StudentValidController');
  Route::resource('/student/rankview', 'StudentResultRankController');
Route::resource('/student/jplasdown', 'JplasDownloadController');

  Route::resource('/student/uitasks', 'UiTopicStdController');
  Route::get('student/uifeedback/{topic}', 'UiFeedbackController@create');
  Route::resource('/student/uifeedback', 'UiFeedbackController');
  Route::resource('/student/uiresview', 'UiStudentResultViewController');
  Route::get('/student/uistudentres/{id}', 'UiStudentValidController@show');
  Route::get('/student/uiuploadsrc/{topicid}/{id}', 'UiStudentValidController@showsource');

  Route::resource('/student/exercise', 'ExerciseStdController');
  Route::resource('/student/exercisesubmission', 'ExerciseSubmissionController');
  Route::resource('/student/exercisevalid', 'ExerciseStdValidController');



  /** Python */
  //Tampilan topik
  Route::get('/student/python/task', [ExercisePythonController::class, 'index']);
  //Tampilan detail percobaan
  Route::get('/student/python/taskdetail/{id_topik}', [ExercisePythonController::class, 'detail_percobaan']);
  //Tampilan pengerjaan (Teks Editor)
  Route::get('/student/python/pengerjaan/{id_percobaan}', [ExercisePythonController::class, 'teks_editor']);
  // tampilan feedback
  Route::get('/student/python/feedback/{id_topik}/{id_percobaan}', [ExercisePythonController::class, 'feedback']);
  //Compile Program
  Route::get('/student/python-compile', [ExercisePythonController::class, 'compiler']);
  //tampilan data validation
  Route::get('student/python/tampil-data-validation', [ExercisePythonController::class, 'dataValidation']);
  //tampilan result mahasiswa
  Route::get('student/python/result', [ResultController::class, 'index']);
  Route::get('pythonfeedback', [ExercisePythonController::class, 'feedback_submit']);


  Route::get("student/python-history/{id_topik}/{id_percobaan}", [ExercisePythonController::class, 'submit_history']);


});

Route::middleware(['auth'])->group(function () {
    Route::get('download/guide/{file}/{topic}', 'DownloadController@downGuide')->name('file-download');
    Route::get('download/test/{file}/{topic}', 'DownloadController@downTest')->name('file-download');
    Route::get('download/supp/{file}/{topic}', 'DownloadController@downSupplement')->name('file-download');
    Route::get('download/other/{file}/{topic}', 'DownloadController@downOther')->name('file-download');
  // exercise
  Route::get('download/exerciseguide/{file}/{topic}', 'DownloadController@downExerciseGuide')->name('file-download');
  Route::get('download/exercisetest/{file}/{topic}', 'DownloadController@downExerciseTest')->name('file-download');
  Route::get('download/exercisesupp/{file}/{topic}', 'DownloadController@downExerciseSupplement')->name('file-download');
  Route::get('download/exerciseother/{file}/{topic}', 'DownloadController@downExerciseOther')->name('file-download');
  // jplas
Route::get('download/jpack/{file}/{topic}', 'DownloadController@downJplasPackage')->name('file-download');
Route::get('download/jguide/{file}/{topic}', 'DownloadController@downJplasGuide')->name('file-download');
Route::get('download/jresult/{file}/{topic}', 'DownloadController@downJplasResult')->name('file-download');


});

Auth::routes();
//Route::get('register', 'Auth\RegisterController@index')->name('register');
//Route::get('register', 'Auth\RegisterController@register');

Route::get('/home', 'HomeController@index')->name('home');

// Route::get("/readfiles", function() {

//   // $directory = './python-resources/unittest/bab1_percobaan1.py';
//   // $lines = file( $directory );
//   // print_r( $lines );

//   // header("Content-Type: application/json");

//   $text = "@codewars_test.describe('BAB 1') \n\n
//   def percobaan1():
//       @codewars_test.it('|Test Output Polinema-')";

//   echo $text;
// });
