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

        return view('portal.cms.cmsoptions', ['portalUser'=>$portalUser]);
    }

    public function showAddCmsPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.cms.addcms', ['portalUser'=>$portalUser]);
    }

    public function addItem(Request $request){
        #dd($request->all());

        $cmsType = null;
        if($request->cms_type === "news"){
            $cmsType = 0;
        }
        elseif($request->cms_type === "blog"){
            $cmsType = 1;
        }
        else{
            $cmsType = 2;
        }

        $cms_title = $request->cms_title;
        $cms_parag_1 = $request->cms_parg_1;
        $cms_image_1 = $request->file('add_image_1')->getClientOriginalName();
        $extension = $request->file('add_image_1')->getClientOriginalExtension();
        $fileNameToStore1 = $cmsType. (count(Blog::all()) + 1 ) . 'img1' . '_' . time() . '.' . $extension;
        $path1 = $request->file('add_image_1')->storeAs('public/news_images/',$fileNameToStore1);

        $cms_parag_2 = null;
        $cms_parag_3 = null;

        $cms_image_2 = null;
        $cms_image_3 = null;

        $fileNameToStore2 = null;
        $fileNameToStore3 = null;
        $path2 = null;
        $path3 = null;

        if($request->cms_parg_2){
            $cms_parag_2 = $request->cms_parg_2;
        }
        if($request->cms_parg_3){
            $cms_parag_3 = $request->cms_parg_3;
        }

        if($request->add_image_2){
            $cms_image_2 = $request->file('add_image_2')->getClientOriginalName();
            $extension = $request->file('add_image_2')->getClientOriginalExtension();
            $fileNameToStore2 = $cmsType. (count(Blog::all()) + 1 ) . 'img2' . '_' . time() . '.' . $extension;
            $path2 = $request->file('add_image_2')->storeAs('public/news_images/',$fileNameToStore2);
        }
        if($request->add_image_3){
            $cms_image_3 = $request->file('add_image_3')->getClientOriginalName();
            $extension = $request->file('add_image_3')->getClientOriginalExtension();
            $fileNameToStore3 = $cmsType. (count(Blog::all()) + 1 ) . 'img3' . '_' . time() . '.' . $extension;
            $path3 = $request->file('add_image_3')->storeAs('public/news_images/',$fileNameToStore3);
        }

        $blog = Blog::create([
            'cms_type'=>$cmsType, 
            'cms_title'=>$cms_title,
            'cms_parg_1'=>$cms_parag_1,
            'cms_parg_2'=>$cms_parag_2,
            'cms_parg_3'=>$cms_parag_3,
            'image_1'=>$fileNameToStore1,
            'image_2'=>$fileNameToStore2,
            'image_3'=>$fileNameToStore3,
            'author'=>Auth::user()->fullName(),
        ]);

        return redirect()->back()->with(['success'=>'Blog was succesfully published.']);
    }

    public function showViewCmsPage(){
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        $blogs = Blog::all();

        return view('portal.cms.viewcms', ['portalUser'=>$portalUser, 'blogs'=>$blogs]);
    }

    public function getBlogContent(Request $request){
        $blog = Blog::where('id', $request->blogid)->first();

        return response(['blog_id'=>$blog->id, 'blog_type'=>$blog->getBlogType(), 'blog_title'=>$blog->cms_title, 'parag_1'=>$blog->cms_parg_1,
                        'parag_2'=>$blog->cms_parg_2,'parag_3'=>$blog->cms_parg_3, 'image_1'=>$blog->image_1,
                        'image_2'=>$blog->image_2, 'image_3'=>$blog->image_3, 'author'=>$blog->author, 'created'=>$blog->created_at, 'updated'=>$blog->updated_at], 200);
    }

    public function deleteBlog(Request $request){
        $blog = Blog::where('id', $request->blogid)->first();
        $blog->delete();
        return response('', 200);
    }

    public function showEditCmsPage($id){

        $blog = Blog::where('id', $id)->first();
        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.cms.addcms', ['portalUser'=>$portalUser, 'blog'=>$blog]);
    }

    public function editCmsPost(Request $request){

        $cmsType = null;
        if($request->cms_type === "news"){
            $cmsType = 0;
        }
        else{
            $cmsType = 1;
        }

        $blog = Blog::where('id', $request->blogid)->first();

        $fileNameToStore1 = null;

        $cms_title = $request->cms_title;
        $cms_parag_1 = $request->cms_parg_1;

        if($request->add_image_1){
            $cms_image_1 = $request->file('add_image_1')->getClientOriginalName();
            $extension = $request->file('add_image_1')->getClientOriginalExtension();
            $fileNameToStore1 = $cmsType. (count(Blog::all()) + 1 ) . 'img1' . '_' . time() . '.' . $extension;
            $path1 = $request->file('add_image_1')->storeAs('public/news_images/',$fileNameToStore1);
        }
        else{
            $fileNameToStore1 = $blog->image_2;
        }

        $cms_parag_2 = null;
        $cms_parag_3 = null;

        $cms_image_2 = null;
        $cms_image_3 = null;

        
        $fileNameToStore2 = null;
        $fileNameToStore3 = null;

        if($request->cms_parg_2){
            $cms_parag_2 = $request->cms_parg_2;
        }
        if($request->cms_parg_3){
            $cms_parag_3 = $request->cms_parg_3;
        }

        if($request->add_image_2){
            $cms_image_2 = $request->file('add_image_2')->getClientOriginalName();
            $extension = $request->file('add_image_2')->getClientOriginalExtension();
            $fileNameToStore2 = $cmsType. (count(Blog::all()) + 1 ) . 'img2' . '_' . time() . '.' . $extension;
            $path2 = $request->file('add_image_2')->storeAs('public/news_images/',$fileNameToStore2);
        }
        else{
            if($blog->image_2 !== null){
                $fileNameToStore2 = $blog->image_2;
            }
        }

        if($request->add_image_3){
            $cms_image_3 = $request->file('add_image_3')->getClientOriginalName();
            $extension = $request->file('add_image_3')->getClientOriginalExtension();
            $fileNameToStore3 = $cmsType. (count(Blog::all()) + 1 ) . 'img3' . '_' . time() . '.' . $extension;
            $path3 = $request->file('add_image_3')->storeAs('public/news_images/',$fileNameToStore3);
        }
        else{
            if($blog->image_3 !== null){
                $fileNameToStore2 = $blog->image_3;
            }
        }
       

        $blog->cms_type=$cmsType;
        $blog->cms_title=$cms_title;
        $blog->cms_parg_1=$cms_parag_1;
        $blog->cms_parg_2=$cms_parag_2;
        $blog->cms_parg_3=$cms_parag_3;
        $blog->image_1=$fileNameToStore1;
        $blog->image_2=$fileNameToStore2;
        $blog->image_3=$fileNameToStore3;
        $blog->author=Auth::user()->fullName();
        
        $blog->save();

        return redirect()->back()->with(['success'=>'Blog was succesfully edited.']);
    }
}
