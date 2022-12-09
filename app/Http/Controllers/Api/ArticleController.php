<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $model;

    public function __construct(Article $model){
        $this->model = $model;
    }

    public function index(){
        $datas = $this->model->paginate(10);

        $response = [
            'status' => 'succes',
            'data' => $datas
        ];

        return response()->json($response);
    }

    public function store(Request $request)
    {

        try {
            $input = $request->all();
            $article_image = Storage::disk('public')->put('article_image', $request->file('article_image'));
            $input['article_image'] = $article_image;

            $data  = $this->model->create($input);
            $response = [
                'code' => 200,
                'message' => 'successfully',
                'data' => $data
            ];
        } catch (\Exception $ex) {
            $response = [
                'code' => 500,
                'message' => $ex->getMessage(),
                'data' => null
            ];
        }

        return response()->json($response, $response['code']);
    }

    public function update(Request $request, $id)
    {

        try {
            $input = $request->all();
            // dd($input);
            $data  = $this->model->find($id);

            if ($request->file('article_image')) {
                $path = Storage::disk('public')->path($data->article_image);
                $exists = File::exists($path);
                if ($exists) {
                    File::delete($path);
                }

                $article_image = Storage::disk('public')->put('article_image', $request->file('article_image'));
                $input['article_image'] = $article_image;
            }
            if($data->update($input)) {
                $response = [
                    'code' => 200,
                    'message' => 'successfully',
                    'data' => $data
                ];
            }
        } catch (\Exception $ex) {
            $response = [
                'code' => 500,
                'message' => $ex->getMessage(),
                'data' => null
            ];
        }

        return response()->json($response, $response['code']);
    }

    public function destroy($id)
    {
        try {
            $data = Article::find($id);
            $data->delete();

            $response = [
                'code' => 200,
                'message' => 'successfully',
                'data' => $data
            ];
        } catch (\Exception $ex) {
            $response = [
                'code' => 500,
                'message' => $ex->getMessage(),
                'data' => null
            ];
        }

        return response()->json($response, $response['code']);
    }
}
