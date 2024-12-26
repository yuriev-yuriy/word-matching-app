use App\Http\Controllers\ExcelController;

Route::post('/upload', [ExcelController::class, 'upload']);