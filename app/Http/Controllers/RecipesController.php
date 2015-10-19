<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\RecipesEditFormRequest;
use App\Recipe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;
use Toastr;

class RecipesController extends Controller
{
    public function index()
    {
        $recipes = Recipe::sortable()->paginate(env('RECIPE_PAGINATION_MAX'));
        return view('recipes.index')->with('recipes', $recipes);
    }

    public function fix()
    {
        $recipes = Recipe::orderBy('category')->get();
        foreach ($recipes as $recipe) {
            $recipe->category = ucwords(strtolower(trim($recipe->category)));
            $recipe->name = trim($recipe->name);
            $recipe->author = trim($recipe->author);

            $recipe->category = preg_replace('/^Appetizers/i', 'Appetizer', $recipe->category);
            $recipe->category = preg_replace('/^Breakfast.*?/i', 'Breakfast', $recipe->category);
            $recipe->category = preg_replace('/^Cake.*?/i', 'Cake', $recipe->category);
            $recipe->category = preg_replace('/^Cdake.*?/i', 'Cake', $recipe->category);
            $recipe->category = preg_replace('/^Candies.*?/i', 'Candy', $recipe->category);
            $recipe->category = preg_replace('/^Deserts.*?/i', 'Dessert', $recipe->category);
            $recipe->category = preg_replace('/^Dessert.*?/i', 'Dessert', $recipe->category);
            $recipe->category = preg_replace('/^Dip.*?/i', 'Dip', $recipe->category);
            $recipe->category = preg_replace('/^Meat.*?/i', 'Meat', $recipe->category);
            $recipe->category = preg_replace('/^Mis.*?s.*?/i', 'Miscellaneous', $recipe->category);
            $recipe->category = preg_replace('/^Picckles.*?/i', 'Pickles', $recipe->category);
            $recipe->category = preg_replace('/^Pie.*?/i', 'Pie', $recipe->category);
            $recipe->category = preg_replace('/^Salad.*?/i', 'Salad', $recipe->category);
            $recipe->category = preg_replace('/^Sandwitches.*?/i', 'Sandwich', $recipe->category);
            $recipe->category = preg_replace('/^Sandwich.*?/i', 'Sandwich', $recipe->category);
            $recipe->category = preg_replace('/^Sauce.*?/i', 'Sauce', $recipe->category);
            $recipe->category = preg_replace('/^Sea.*?food.*?/i', 'Seafood', $recipe->category);
            $recipe->category = preg_replace('/^Vegetable.*?/i', 'Vegetable', $recipe->category);
            $recipe->category = preg_replace('/^Vegetales.*?/i', 'Vegetable', $recipe->category);

            $recipe->name = preg_replace('/^Appetizer.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Beverage.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Bread.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Breakfast.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Cake.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Candy.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Cobbler.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Cookies.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Cupcake.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Dessert.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Dip.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Entree.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Frosting.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Ice Cream.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Miscellaneous.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Pastery.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Pickle.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Pies.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Salad.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Sandwich.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Sauce.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Sea.*?food.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Soup.*?-\s+/i', '', $recipe->name);
            $recipe->name = preg_replace('/^Vegetable.*?-\s+/i', '', $recipe->name);

            $recipe->author = preg_replace("/[\/\']/", '', $recipe->author);
            $recipe->author = preg_replace('/Fay.s|Faye.s|Faye Martin Thompson/i', 'Faye Thompson', $recipe->author);
            $recipe->author = preg_replace('/Mrs. John Collier/i', 'Alice Collier', $recipe->author);
            $recipe->author = preg_replace('/Unknown/i', '', $recipe->author);

            if (preg_match('/McCutchen/i', $recipe->author, $match)) {
                $recipe->author = "Jeannean McCutchen";
            }

            if (preg_match('/^Faye$/i', $recipe->author, $match)) {
                $recipe->author = "Faye Thompson";
            }

            if (preg_match('/Mary Alice/i', $recipe->author, $match)) {
                $recipe->author = "Mary Alice McComb";
            }

            $recipe->save();
        }
        $recipes = Recipe::sortable()->paginate(env('RECIPE_PAGINATION_MAX'));
        return view('recipes.index')->with('recipes', $recipes);
    }

    public function menu()
    {
        $recipes = Recipe::orderBy('category')->orderBy('name')->get();
        return view('recipes.menu')->with('recipes', $recipes);
    }

    public function search(Request $request)
    {
        $token = $request->get('token');
        $recipes = Recipe::where('name', 'LIKE', '%' . $token . '%')
            ->orWhere('category', 'LIKE', '%' . $token . '%')
            ->orWhere('recipe', 'LIKE', '%' . $token . '%')
            ->orWhere('author', 'LIKE', '%' . $token . '%')
            ->orderBy('category')
            ->orderBy('name')
            ->paginate(env('RECIPE_PAGINATION_MAX'));
        return view('recipes.index')->with('recipes', $recipes);
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $recipe = new Recipe(array(
            'category' => $request->get('category'),
            'name' => $request->get('name'),
            'author' => $request->get('author'),
            'recipe' => $request->get('recipe'),
        ));
        $recipe->save();
        Toastr::success('Recipe created.');
        return redirect('/recipes');
    }

    public function show($id)
    {
        $recipe = Recipe::whereId($id)->firstOrFail();
        return view('recipes.show')->with('recipe', $recipe);
    }

    public function edit($id)
    {
        $recipe = Recipe::whereId($id)->firstOrFail();
        return view('recipes.edit')->with('recipe', $recipe);
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::whereId($id)->firstOrFail();
        $recipe->category = trim($request->get('category'));
        $recipe->name = trim($request->get('name'));
        $recipe->author = trim($request->get('author'));
        $recipe->recipe = trim($request->get('recipe'));
        $recipe->save();
        Toastr::success('Recipe updated.');
        return redirect(action('RecipesController@index', $recipe->id));
    }

    public function destroy($id)
    {
        Recipe::find($id)->delete();
        $recipes = Recipe::orderBy('name')->paginate(env('PAGINATION_MAX'));
        return view('recipes.index')->with('recipes', $recipes);
    }

    public function recipesExcel()
    {
        $table = with(new Recipe)->getTable();
        $data = DB::select(DB::raw("SELECT * FROM $table"));
        $data = json_encode($data);
        SELF::data2excel('Excel', 'Sheet1', json_decode($data, true));
    }

    public function recipePdf($id)
    {
        $recipe = Recipe::whereId($id)->firstOrFail();
        $view = view('reports.recipe')->with('vm', $recipe);
        $contents = $view->render();
        SELF::html2pdf($contents);
    }

    public function recipesPdf($offset = 0, $limit = 1)
    {
        $table = with(new Recipe)->getTable();
        $recipes = DB::select(DB::raw("SELECT * FROM $table ORDER BY category, name LIMIT $offset, $limit"));
        $view = view('reports.recipes')->with('recipes', $recipes);
        $contents = $view->render();
        SELF::html2pdf($contents);
    }

    public function recipesHtml($offset = 0, $limit = 1)
    {
        $table = with(new Recipe)->getTable();
        $recipes = DB::select(DB::raw("SELECT * FROM $table ORDER BY category, name LIMIT $offset, $limit"));
        return view('reports.recipes')->with('recipes', $recipes);
    }

    public function data2excel($excel, $sheet, $data)
    {
        $this->excel = $excel;
        $this->sheet = $sheet;
        $this->data = $data;
        Excel::create($this->excel, function ($excel) {
            $excel->sheet('Sheetname', function ($sheet) {
                $sheet->appendRow(array_keys($this->data[0])); // column names
                foreach ($this->data as $field) {
                    $sheet->appendRow($field);
                }
            });
        })->export('xlsx');
    }

    public function html2pdf($html)
    {
        $font_size = 8;
        $pdf = new TCPDF();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetFont('times', '', $font_size, '', 'default', true);
        $pdf->AddPage("L");
        $pdf->writeHTML($html);
        $filename = '/report.pdf';
        $pdf->Output($filename, 'I');
    }

}
