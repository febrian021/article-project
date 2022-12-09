<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Alert;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller {
    protected $model;
    protected $title = 'Article';
    protected $view = 'pages.article.';
    protected $route = 'article.';

    public function __construct(Article $model){
        $this->model = $model;

        View::share('route', $this->route);
        View::share('title', $this->title);
        View::share('view', $this->view);
    }

    public function index(){
        $articles = $this->model->paginate(10);
        return view($this->view.'index', compact('articles'));
    }

    public function create()
    {
        $users = User::all();
        return view($this->view.'create', compact('users'));
    }

    public function store(ArticleRequest $req){
        $input = $req->all();
        $article_image = Storage::disk('public')->put('article_image', $req->file('article_image'));
        $input['article_image'] = $article_image;
        $input['user_id'] = Auth::user()->id;

        $data  = $this->model->create($input);

        if($data){
            $articles = Article::all();
            Cache::put('articles', $articles);

            Alert::success('Berhasil', 'Data telah berhasil disimpan');
            return redirect()->route($this->route.'index');
        }
        Alert::error('Gagal', 'Data telah gagal disimpan');
        return redirect()->back();
    }

    public function edit($id){
        $article = $this->model->findOrFail($id);
        return view($this->view.'edit', compact('article', 'id'));
    }

    public function show($id){
        $article = $this->model->findOrFail($id);
        return view($this->view.'show', compact('article', 'id'));
    }

public function update(ArticleRequest $req, $id){
        $input = $req->all();

        $data  = $this->model->findOrFail($id);

        if ($req->file('article_image')) {
            $path = Storage::disk('public')->path($data->article_image);
            $exists = File::exists($path);
            if ($exists) {
                File::delete($path);
            }

            $article_image = Storage::disk('public')->put('article_image', $req->file('article_image'));
            $input['article_image'] = $article_image;
        }

        if($data->update($input)){
            $articles = Article::all();
            Cache::put('articles', $articles);

            Alert::success('Berhasil', 'Data telah berhasil disimpan');
            return redirect()->route($this->route.'index');
        }
        Alert::error('Gagal', 'Data telah gagal disimpan');
        return redirect()->back();
    }

    public function destroy($id){
        $data = $this->model->findOrFail($id);
        if($data->delete()){
            Alert::success('Berhasil', 'Data telah berhasil dihapus');
            return redirect()->route($this->route.'index');
        }
        Alert::error('Gagal', 'Data telah gagal dihapus');
        return redirect()->back();
    }
}
