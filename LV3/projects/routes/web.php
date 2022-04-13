 <?php

 use App\Http\Controllers\Projects;
 use Illuminate\Support\Facades\Route;

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

 Route::middleware(['auth','verified'])->group(function(){
     Route::get('/dashboard', [Projects::class, 'index'])->name('dashboard');

     Route::get('/create', [Projects::class, 'create'])->name('create');

     Route::post('/store',[Projects::class, 'store'])->name('store');

     Route::get('/project/{id}', [Projects::class, 'show'])->name('project');
 });

require __DIR__.'/auth.php';
