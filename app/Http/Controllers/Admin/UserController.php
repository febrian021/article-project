<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\View;
use App\Http\Requests\UserRequest;
use Alert;

class UserController extends Controller {
    protected $model;
    protected $title = 'User Mananegement';
    protected $view = 'pages.user.';
    protected $route = 'user.';

    public function __construct(User $model){
        $this->model = $model;

        View::share('route', $this->route);
        View::share('title', $this->title);
        View::share('view', $this->view);
    }

    public function index(){
        $users = $this->model->paginate(10);
        return view($this->view.'index', compact('users'));
    }

    public function create()
    {
        return view($this->view.'create');
    }

    public function store(UserRequest $req){
        $input = $req->all();
        $input['password'] = bcrypt($input['password']);

        $data  = $this->model->create($input);

        if($data){
            Alert::success('Berhasil', 'Data telah berhasil disimpan');
            return redirect()->route($this->route.'index');
        }
        Alert::error('Gagal', 'Data telah gagal disimpan');
        return redirect()->back();
    }

    public function edit($id){
        $user = $this->model->findOrFail($id);
        return view($this->view.'edit', compact('user', 'id'));
    }

    public function show($id){
        $user = $this->model->findOrFail($id);
        return view($this->view.'show', compact('user', 'id'));
    }

    public function update(UserRequest $req, $id){
        $input = $req->all();
        if(isset($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }else{
            unset($input['password']);
        }

        $data  = $this->model->findOrFail($id);
        if($data->update($input)){
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
