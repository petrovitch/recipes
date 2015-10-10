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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::orderBy('category')->orderBy('name')->paginate(env('RECIPE_PAGINATION_MAX'));
        return view('recipes.index')->with('recipes', $recipes);
    }

    public function search($token = 'rice')
    {
        $recipes = Recipe::where('name', 'LIKE', '%' . $token . '%')
            ->orWhere('category', 'LIKE', '%' . $token . '%')
            ->orWhere('recipe', 'LIKE', '%' . $token . '%')
            ->orWhere('instructions', 'LIKE', '%' . $token . '%')
            ->orderBy('category')
            ->orderBy('name')
            ->paginate(env('RECIPE_PAGINATION_MAX'));
        return view('recipes.index')->with('recipes', $recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recipe = new Recipe(array(
            'category' => $request->get('category'),
            'name' => $request->get('name'),
            'author' => $request->get('author'),
            'recipe' => $request->get('recipe'),
            'instructions' => $request->get('instructions'),
            'microwave' => $request->get('microwave'),
        ));
        $recipe->save();
        Toastr::success('Recipe created.');
        return redirect('/recipes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::whereId($id)->firstOrFail();
        return view('recipes.show')->with('recipe', $recipe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::whereId($id)->firstOrFail();
        return view('recipes.edit')->with('recipe', $recipe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recipe = Recipe::whereId($id)->firstOrFail();
        $recipe->category = trim($request->get('category'));
        $recipe->name = trim($request->get('name'));
        $recipe->author = trim($request->get('author'));
        $recipe->recipe = trim($request->get('recipe'));
        $recipe->instructions = trim($request->get('instructions'));
        $recipe->microwave = $request->get('microwave');
        $recipe->save();
        Toastr::success('Recipe updated.');
        return redirect(action('RecipesController@index', $recipe->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recipe::find($id)->delete();
        $recipes = Recipe::orderBy('name')->paginate(env('PAGINATION_MAX'));
        return view('recipes.index')->with('recipes', $recipes);
    }


    public function recipesExcel()
    {
        $data = DB::select(DB::raw("SELECT * FROM recipes"));
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
        $recipes = DB::select(DB::raw("SELECT * FROM recipes ORDER BY category, name LIMIT $offset, $limit"));
        $view = view('reports.recipes')->with('recipes', $recipes);
        $contents = $view->render();
        SELF::html2pdf($contents);
    }

    public function recipesHtml($offset = 0, $limit = 1)
    {
        $recipes = DB::select(DB::raw("SELECT * FROM recipes ORDER BY category, name LIMIT $offset, $limit"));
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
