php artisan make:controller ExcelController
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
public function upload(Request $request)
{
$request->validate([
'file' => 'required|mimes:xlsx,xls,csv',
]);

$file = $request->file('file');
$data = Excel::toArray([], $file);

// Извлекаем строки из первой таблицы
$rows = collect($data[0]);

return response()->json($rows);
}
}