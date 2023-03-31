<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Dashboard\AnalyticsController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BiometricController;
use App\Http\Controllers\GFormController;
use App\Http\Controllers\DTRController;

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

$controller_path = 'App\Http\Controllers';


// authentication
Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('auth-login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('auth-authenticate');
});
// Route::get('/auth/register-basic', $controller_path . '\Authentication\RegisterBasic@index')->name('auth-register-basic');
// Route::get('/auth/forgot-password-basic', $controller_path . '\Authentication\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

// Main Page Route
Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [AnalyticsController::class, 'index'])->name('dashboard-analytics');
    Route::get('/logout', [LoginController::class, 'logout'])->name('auth-logout');

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users-index');
    });

    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees-index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees-create');
        Route::post('/', [EmployeeController::class, 'store'])->name('employees-store');
        Route::get('/edit/{employee_id}', [EmployeeController::class, 'edit'])->name('employees-edit');
        Route::put('/update/{employee_id}', [EmployeeController::class, 'update'])->name('employees-update');
        Route::get('/delete/{employee_id}', [EmployeeController::class, 'delete'])->name('employees-delete');
        Route::delete('/destroy/{employee_id}', [EmployeeController::class, 'destroy'])->name('employees-destroy');
    });

    Route::prefix('attendance')->group(function () {
        Route::get('/merged', [AttendanceController::class, 'index'])->name('attendance-merged');
        
        Route::prefix('gforms')->group(function () {
            Route::get('/', [GFormController::class, 'index'])->name('attendance-gforms');
            Route::get('/upload-page', [GFormController::class, 'create'])->name('attendance-gforms-create');
            Route::post('/upload', [GFormController::class, 'upload'])->name('attendance-gforms-upload');
            Route::post('/store', [GFormController::class, 'store'])->name('attendance-gforms-store');
        });

        Route::prefix('biometrics')->group(function () {
            Route::get('/', [BiometricController::class, 'index'])->name('attendance-biometrics');
            Route::get('/upload-page', [BiometricController::class, 'create'])->name('attendance-biometrics-create');
            Route::post('/upload', [BiometricController::class, 'upload'])->name('attendance-biometrics-upload');
            Route::post('/store', [BiometricController::class, 'store'])->name('attendance-biometrics-store');
        });

        Route::prefix('dtr')->group(function () {
            Route::get('/', [DTRController::class, 'index'])->name('attendance-dtr');
            Route::get('/print', [DTRController::class, 'print'])->name('print-dtr');
        });
    });
});



// // layout
// Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
// Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
// Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
// Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
// Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// // pages
// Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
// Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
// Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
// Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
// Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

// // cards
// Route::get('/cards/basic', $controller_path . '\cards\CardBasic@index')->name('cards-basic');

// // User Interface
// Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');
// Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');
// Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');
// Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');
// Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');
// Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');
// Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');
// Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');
// Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');
// Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');
// Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');
// Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');
// Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
// Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');
// Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');
// Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');
// Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');
// Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
// Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');

// // extended ui
// Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
// Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

// // icons
// Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');

// // form elements
// Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');
// Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');

// // form layouts
// Route::get('/form/layouts-vertical', $controller_path . '\form_layouts\VerticalForm@index')->name('form-layouts-vertical');
// Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

// // tables
// Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');
