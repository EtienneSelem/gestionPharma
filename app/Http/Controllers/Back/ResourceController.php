<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ResourceController extends Controller
{

    
    protected $dataTable;
    protected $view;
    protected $formRequest;
    protected $singular;

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(!app()->runningInConsole()) {

            $segment = getUrlSegment(request()->url(), 2); // categories ou newcategories
            
            if(substr($segment, 0, 3) === 'new') {
                $segment = substr($segment, 3);
            }

            $name = substr($segment, 0, -1); // categorie
            $this->singular = Str::singular($segment); // category

            $model = ucfirst($this->singular); // Category

            $this->model = 'App\Models\\' . $model; 
            $this->dataTable = 'App\DataTables\\' . ucfirst($name) . 'sDataTable';
            $this->view = 'back.' . $name . 's.form';
            $this->formRequest = 'App\Http\Requests\Back\\' . $model . 'Request'; 
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return app()->make($this->dataTable)->render('back.shared.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $request = app()->make($this->formRequest);
        
        app()->make($this->model)->create($request->all());

        return back()->with(['ok' => __('The ' . $this->singular . ' has been successfully created.')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $element = app()->make($this->model)->find($id);

        return view($this->view, [$this->singular => $element]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $request = app()->make($this->formRequest);

        app()->make($this->model)->find($id)->update($request->all());

        return back()->with(['ok' => __('The ' . $this->singular . ' has been successfully updated.')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        app()->make($this->model)->find($id)->delete();

        return response()->json();
    }
}

