<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index(){
        $roles = Role::select('roleid', 'role_name')->where('isactive','1')->orderBy('roleid')->get();
        $menus = Menu::where('parent_id', '=', 0)->get();
        $allMenus = Menu::pluck('title','id')->all();
        return view('menu.index',compact('roles','menus','allMenus')); //
    }

    public function store(Request $request)
    {
        //dd($request);
        $rules = [
            'title' => 'required|string|max:50',
            'url' => 'required|max:50',
            //'icon' => 'string|max:50',
            'role' => 'required|integer',
            'order' => 'required|integer',
            //'parent_id' => 'integer',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('menus.index')->withInput()->withErrors($validator);
		}else{
            $data = $request->input();
            try{
                $menu = new Menu;
                $menu->title = !empty($data['title']) ? $data['title'] : '' ;
                $menu->url = !empty($data['url']) ? $data['url'] : '' ;
                $menu->icon = !empty($data['icon']) ? $data['icon'] : '' ;
                $menu->roleid = !empty($data['role']) ? $data['role'] : '' ;
                $menu->order = !empty($data['order']) ? $data['order'] : '' ;
                $menu->parent_id = empty($data['parent_id']) ? 0 : $data['parent_id'];
                $menu->created_at = Carbon::now();
                $menu->updated_at = null;
                $menu->save();
                return redirect()->route('menus.index')
                                ->with('status','Menu added successfully.');
            }catch(Exception $e){
                return redirect()->route('menus.index')->with('failed',"operation failed");
            }
        }

    }

    public function show()
    {
        $menus = Menu::where('parent_id', '=', 0)->get();
        return view('menu.dynamicMenu',compact('menus'));
    }
}
