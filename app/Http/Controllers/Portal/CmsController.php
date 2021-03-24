<?php

namespace App\Http\Controllers\Portal;

use App\Eloquent\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Eloquent\PortalUsers;

class CmsController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }
    
    public function showCmsPage(){
        //if(!$this->checkAuthLevel(11)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.cms.cms')->with('portalUser', $portalUser);
    }

    public function addItem(Request $request){
        #dd($request->all());

        $cmsType = null;
        if($request->cms_type === "news"){
            $cmsType = 0;
        }
        else{
            $cmsType = 1;
        }

        $cms_title = $request->cms_title;
        $cms_parag_1 = $request->cms_parg_1;
        $cms_image_1 = $request->file('add_image_1')->getClientOriginalName();
        $extension = $request->file('add_image_1')->getClientOriginalExtension();
        $fileNameToStore = $cmsType. (count(Blog::all()) + 1 ) . 'img1' . '_' . time() . '.' . $extension;
        $path = $request->file('add_image_1')->storeAs('public/news_images',$fileNameToStore);

        $cms_parag_2 = null;
        $cms_parag_3 = null;

        $cms_image_2 = null;
        $cms_image_3 = null;

        if($request->cms_parg_2){
            $cms_parag_2 = $request->cms_parg_2;
        }
        if($request->cms_parg_3){
            $cms_parag_3 = $request->cms_parg_3;
        }

        if($request->add_image_2){
            $cms_image_2 = $request->file('add_image_2')->getClientOriginalName();
            $extension = $request->file('add_image_2')->getClientOriginalExtension();
            $fileNameToStore = $cmsType. (count(Blog::all()) + 1 ) . 'img2' . '_' . time() . '.' . $extension;
            $path = $request->file('add_image_2')->storeAs('public/news_images',$fileNameToStore);
        }
        if($request->add_image_3){
            $cms_image_3 = $request->file('add_image_3')->getClientOriginalName();
            $extension = $request->file('add_image_3')->getClientOriginalExtension();
            $fileNameToStore = $cmsType. (count(Blog::all()) + 1 ) . 'img3' . '_' . time() . '.' . $extension;
            $path = $request->file('add_image_3')->storeAs('public/news_images',$fileNameToStore);
        }

        $blog = Blog::create([
            'cms_type'=>$cmsType, 
            'cms_title'=>$cms_title,
            'cms_parg_1'=>$cms_parag_1,
            'cms_parg_2'=>$cms_parag_2,
            'cms_parg_3'=>$cms_parag_3,
            'image_1'=>$cms_image_1,
            'image_2'=>$cms_image_2,
            'image_3'=>$cms_image_3,
            'author'=>Auth::user()->fullName(),
        ]);
    }
}
