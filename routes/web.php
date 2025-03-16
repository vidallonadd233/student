<?php
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CaseReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StudentController;

use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ReportIncidentsController;
use App\Http\Controllers\AdminReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Unique;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AdminController;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\StudentArchiveController;
use App\Http\Controllers\ReportArchiveController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Guest routes (unauthenticated users only)
// Guest routes (unauthenticated users only)






// Home Page (accessible by all)
Route::get('/', [LandingController::class, 'home'])->name('home');

// About, Contact, Privacy, Terms pages (static information pages)
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');

// Resource route for downloadable resources or articles



// Student-specific routes


    Route::resource('report_incidents', ReportIncidentsController::class);


    Route::post('/upload-evidence', [ReportIncidentsController::class, 'uploadEvidence'])->name('upload.evidence');
// Display the list of archived reports
// Display archived reports


Route::get('/archive/report', [ReportIncidentsController::class, 'ShowArchived'])->name('archive.report');
Route::post('/report_incidents/{id}/archive', [ReportIncidentsController::class, 'archive'])->name('report_incidents.archive');
Route::post('/report_incidents/{id}/restore', [ReportIncidentsController::class, 'restore'])->name('report_incidents.restore');

    Route::delete('/report_incidents/{id}/destroy', [ReportIncidentsController::class, 'destroy'])->name('report_incidents.destroy');

Route::put('/report_incidents/{id}/update', [ReportIncidentsController::class, 'update'])->name('report_incidents.update');
Route::get('/report_incidents/{id}/edit', [ReportIncidentsController::class, 'edit'])->name('report_incidents.edit');

    Route::post('/student/logout', [RegistrationController::class, 'studentLogout'])->name('logout.student');


    Route::get('/register', [RegistrationController::class, 'create'])->name('register.create');
    Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');
    // Password Reset Routes
    Route::get('password/create', [NewPasswordController::class, 'showCreateForm'])->name('password.create');
    Route::post('password/create', [NewPasswordController::class, 'create'])->name('password.store');
    Route::get('/logins', [LoginsController::class, 'Showformlogins'])->name('logins.form');
        Route::post('/logins', [LoginsController::class, 'logins'])->name('logins.submit');

Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [LoginController::class, 'loginOrCreate'])->name('admin.login');

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::put('/admin/reports/{id}/status', [ReportIncidentsController::class, 'updateStatus'])->name('admin.updateStatus');
    Route::get('/admin/reports/solved', [ReportIncidentsController::class, 'solvedReports'])->name('admin.solvedReports');



Route::get('/admin/archive-reports', [AdminReportController::class, 'archivedReports'])->name('admin.archive-reports');
Route::put('/admin/restore-report/{id}', [AdminReportController::class, 'restoreReport'])->name('admin.restore-report');
Route::delete('/admin/delete-report/{id}', [AdminReportController::class, 'deleteReport'])->name('admin.delete-report');
Route::put('/admin/archive-report/{id}', [AdminReportController::class, 'archiveReport'])->name('admin.archive-report');


    // routes/web.php
Route::get('/analytics', [DashboardController::class, 'analytics']);

    // Notifications & Activities
    Route::delete('/admin/activity-logs/{id}', [ActivityLogController::class, 'destroy'])->name('admin.activity-logs.destroy');

    Route::get('/admin/activity-log', [ActivityLogController::class, 'index'])->name('admin.activity-log');
    Route::put('/admin/reports/update-can-report/{id}', [ReportIncidentsController::class, 'updateCanReport'])->name('reports.updateCanReport');

    Route::resource('/admin/calendar', CalendarController::class);
    Route::get('/admin/calendar', [CalendarController::class, 'index'])->name('admin.calendar');
   Route::get('/admin/archives/calendar', [CalendarController::class, 'showArchivedCalendars'])->name('admin.archives.calendar');
   Route::post('admin/archives/restore/{id}', [CalendarController::class, 'restore'])->name('admin.restore-calendar');
// Archive a Schedule
Route::post('/admin/schedules/store', [CalendarController::class, 'store'])->name('admin.schedules.store');


// Route to display the edit form for a specific schedule
Route::get('/admin/calendar/{id}/edit', [CalendarController::class, 'edit'])->name('admin.calendar.edit');
Route::delete('/admin/calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('admin.delete-calendar');

// Route to update the schedule (using PUT or PATCH)
Route::post('/admin/calendar/{id}', [CalendarController::class, 'update'])->name('admin.calendar.update');

Route::post('/admin/archives/archive/{id}', [CalendarController::class, 'archive'])->name('admin.calendar.archive');

/// Students
Route::get('/students/archived', [RegistrationController::class, 'showArchived'])->name('students.showArchived');
Route::post('/students/archive/{id}', [RegistrationController::class, 'StudentArchive'])->name('students.archive');

        Route::get('students/index',[RegistrationController::class,'index'])->name('students.index');
            // Route to restore an archived student
            Route::post('/students/restore/{id}', [RegistrationController::class, 'restore'])->name('students.restore');
            Route::delete('/students/destroy/{id}', [RegistrationController::class, 'destroy'])->name('students.destroy');
     Route::get('/students/index', [StudentArchiveController::class, 'index'])->name('students.index');

     Route::get('/students/{id}/edit', [RegistrationController::class, 'edit'])->name('students.edit');
     Route::put('/students/{id}', [RegistrationController::class, 'update'])->name('students.update');


    Route::get('generate_pdf/calendar_pdf', [CalendarController::class, 'generatePdf'])->name('admin.calendar.pdf');
    Route::get('/admin/calendar_date', [CalendarController::class, 'events'])->name('calendar.events');
    // Reporting & Analytics
    Route::get('/generate_pdf/report_pdf', [ReportIncidentsController::class, 'exportToPdf'])->name('report_incidents.pdf');
    Route::get('/admin/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics');

    // Admin Profile and Logout
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/logout', [LoginController::class, 'adminLogout'])->name('logout.admin');
// Archived Reports and Schedules
// Updated route definition
Route::get('/archive/report', [ArchiveController::class, 'index'])->name('archive.report');
// Archive Specific Report or Schedule
Route::get('/admin/view-reports', [ReportIncidentsController::class, 'viewReports'])->name('admin.viewReports');
Route::post('/admin/calendar/archive', [CalendarController::class, 'archive'])->name('admin.archive.calendar');

Route::get('/student/calendar_date', [CalendarController::class, 'events'])->name('student.calendar_events');
// Registration Routes
Route::get('/register', [RegistrationController::class, 'create'])->name('register.create');
Route::post('/register', [RegistrationController::class, 'store'])->name('register.store');


// Password Reset Routes
Route::get('password/create', [NewPasswordController::class, 'showCreateForm'])->name('password.create');
Route::post('password/create', [NewPasswordController::class, 'create'])->name('password.store');
 Route::get('/logins', [LoginsController::class, 'Showformlogins'])->name('logins.form');
    Route::post('/logins', [LoginsController::class, 'logins'])->name('logins.submit');
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
