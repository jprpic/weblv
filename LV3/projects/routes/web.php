 <?php

 use App\Http\Controllers\Projects;
 use App\Http\Controllers\ProjectUser;
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

     Route::get('/edit/{id}',[Projects::class, 'edit'])->name('edit');

     Route::put('/project/{id}', [Projects::class, 'update'])->name('update');

     Route::get('/project/{id}', [Projects::class, 'show'])->name('project');

     Route::get('/finish/{id}', [Projects::class, 'finish'])->name('finish');

     Route::post('/project/user/store', [ProjectUser::class, 'store'])->name('user.store');

     Route::post('/project/user/destroy', [ProjectUser::class, 'destroy'])->name('user.destroy');

     Route::get('/profile/{id}', [ProjectUser::class, 'showProfile'])->name('user.profile');


 });


require __DIR__.'/auth.php';
