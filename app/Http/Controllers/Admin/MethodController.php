<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\Method;
use App\Model\admin\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class MethodController extends Controller {

    protected $methods;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Method $methods) {
        $this->middleware('auth:admin');        
        $this->methods = $methods;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
        $page = (int) Input::get('page', 1);        
        $cname = Input::get('cname', null);
        $aname = Input::get('name', null);
        $lname = Input::get('label', null);
        
        $where = array();
        
        if ($aname) {
            $where[] = ['methods.name', 'LIKE', '%'.$aname.'%'];
        }
        if ($lname) {
            $where[] = ['methods.label', 'LIKE', '%'.$lname.'%'];
        }
        
        if ($cname) {
            $where[] = ['pages.name', 'LIKE', '%'.$cname.'%'];
        }
        
        $methods = Method::where($where)->join('pages', 'pages.id', '=', 'methods.page_id')->select('methods.*')->paginate(20);
        
        $methods->appends(['cname' => $cname, 'name' => $aname, 'label' => $lname]);
        
        return view('admin.method.index', compact('methods', 'page', 'cname', 'aname', 'lname'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $pages = Page::all();
        return view('admin.method.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'label' => 'required',
            'controller' => 'required',
        ]);
        $method = new Method;
        $method->name = $request->name;
        $method->label = $request->label;
        $method->page_id = $request->controller;
        $method->save();

        return redirect(route('method.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $method = Method::where('id', $id)->first();
        $pages = Page::all();
        return view('admin.method.edit', compact('method', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'label' => 'required',
            'controller' => 'required',
        ]);
        $method = Method::find($id);
        $method->name = $request->name;
        $method->label = $request->label;
        $method->page_id = $request->controller;
        $method->save();
        return redirect(route('method.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Method::where('id', $id)->delete();
        return redirect()->back();
    }

}
