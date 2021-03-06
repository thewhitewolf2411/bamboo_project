<?php

namespace App\Http\Controllers\Portal;

use App\Eloquent\PortalUsers;
use App\Eloquent\RecycleOffer;
use App\Eloquent\SellingProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RecycleOffersController extends Controller
{
    public function __construct(){
        $this->middleware('checkAuth');
    }

    public function index(){
        $portalUser = PortalUsers::find(Auth::user()->id);
        $recycleOffers = RecycleOffer::all();
        return view('portal.recycleoffers.index', [
            'portalUser' => $portalUser,
            'recycleOffers' => $recycleOffers
        ]);
    }

    public function showCreateOffer(){
        $portalUser = PortalUsers::find(Auth::user()->id);
        $devices = SellingProduct::all();
        return view('portal.recycleoffers.createoffer', [
            'portalUser' => $portalUser,
            'devices' => $devices
        ]);
    }

    public function createOffer(Request $request){
        // image upload
        if($request->file('offer_image')->isValid() && $request->file('offer_selling_banner_image')->isValid()) {

            // validation
            $validated = $request->validate([
                'offer_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'offer_tablet_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'offer_mobile_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'offer_selling_banner_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'offer_selling_banner_tablet_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'offer_selling_banner_mobile_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'device' => 'required',
                // 'offer_title' => 'required',
                // 'offer_description' => 'required',
                // 'offer_additional_info' => 'required',
                // 'offer_price' => 'required',
                // 'offer_start_date' => 'required',
                // 'offer_end_date' => 'required',
            ]);

            $image_filename_withext = $validated['offer_image']->getClientOriginalName();
            $image_filename = explode('.', $image_filename_withext)[0];
            $image_extension = $request->offer_image->extension();
            Storage::put('public/recycle_offers_images/'.$image_filename.".".$image_extension, file_get_contents($request->offer_image));

            $tablet_filename_withext = $validated['offer_tablet_image']->getClientOriginalName();
            $tablet_filename = explode('.', $tablet_filename_withext)[0];
            $tablet_extension = $request->offer_tablet_image->extension();
            Storage::put('public/recycle_offers_images/'.$tablet_filename.".".$tablet_extension, file_get_contents($request->offer_tablet_image));

            $mobile_filename_withext = $validated['offer_mobile_image']->getClientOriginalName();
            $mobile_filename = explode('.', $mobile_filename_withext)[0];
            $mobile_extension = $request->offer_mobile_image->extension();
            Storage::put('public/recycle_offers_images/'.$mobile_filename.".".$mobile_extension, file_get_contents($request->offer_mobile_image));

            $banner_filename_withext = $validated['offer_selling_banner_image']->getClientOriginalName();
            $banner_filename = explode('.', $banner_filename_withext)[0];
            $banner_extension = $request->offer_selling_banner_image->extension();
            Storage::put('public/recycle_offers_images/'.$banner_filename.".".$banner_extension, file_get_contents($request->offer_selling_banner_image));

            $tablet_banner_filename_withext = $validated['offer_selling_banner_tablet_image']->getClientOriginalName();
            $tablet_banner_filename = explode('.', $tablet_banner_filename_withext)[0];
            $tablet_banner_extension = $request->offer_selling_banner_tablet_image->extension();
            Storage::put('public/recycle_offers_images/'.$tablet_banner_filename.".".$tablet_banner_extension, file_get_contents($request->offer_selling_banner_tablet_image));

            $mobile_banner_filename_withext = $validated['offer_selling_banner_mobile_image']->getClientOriginalName();
            $mobile_banner_filename = explode('.', $mobile_banner_filename_withext)[0];
            $mobile_banner_extension = $request->offer_selling_banner_mobile_image->extension();
            Storage::put('public/recycle_offers_images/'.$mobile_banner_filename.".".$mobile_banner_extension, file_get_contents($request->offer_selling_banner_mobile_image));

            RecycleOffer::create([
                'device_id' => $request->device,
                'offer_banner' => $image_filename.".".$image_extension,
                'offer_tablet_banner' => $tablet_filename.".".$tablet_extension,
                'offer_mobile_banner' => $mobile_filename.".".$mobile_extension,
                'offer_selling_banner' => $banner_filename.".".$banner_extension,
                'offer_selling_tablet_banner' => $tablet_banner_filename.".".$tablet_banner_extension,
                'offer_selling_mobile_banner' => $mobile_banner_filename.".".$mobile_banner_extension
                // 'offer_title' => $request->offer_title,
                // 'offer_description' => $request->offer_description,
                // 'offer_additional_info' => $request->offer_additional_info,
                // 'offer_price' => $request->offer_price,
                // 'offer_start_date' => Carbon::parse($request->offer_start_date),
                // 'offer_end_date' => Carbon::parse($request->offer_end_date)
            ]);
            
            return redirect('/portal/recycleoffers')->with('success', 'Recycle offer created successfully.');
        }
    }

    public function showOffer($id){
        $recycleOffer = RecycleOffer::findOrFail($id);
        $portalUser = PortalUsers::find(Auth::user()->id);
        $devices = SellingProduct::all();
        return view('portal.recycleoffers.edit', [
            'portalUser' => $portalUser,
            'devices' => $devices,
            'recycleOffer' => $recycleOffer
        ]);
    }

    public function updateRecycleOffer(Request $request){
        $recycleOffer = RecycleOffer::find($request->id);

        $imageWithExt = null;
        $sellBannerImageWithExt = null;
        $tabletBannerImageWithExt = null;
        $mobileImageWithExt = null;
        $mobile_sellBannerImageWithExt = null;
        $tablet_sellBannerImageWithExt = null;

        // main banner
        if($request->file('offer_image')) {
            // validation
            $validated = $request->validate([
                'offer_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'device' => 'required',
            ]);

            // delete previous image
            Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_banner);

            if($request->file('offer_image')->isValid()) {
                $filename_withext = $validated['offer_image']->getClientOriginalName();
                $filename = explode('.', $filename_withext)[0];
                $extension = $request->offer_image->extension();
                Storage::put('public/recycle_offers_images/'.$filename.".".$extension, file_get_contents($request->offer_image));
            }
            
            $imageWithExt = $filename.".".$extension;
        }

        // tablet banner
        if($request->file('offer_tablet_image')) {
            // validation
            $validated = $request->validate([
                'offer_tablet_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'device' => 'required',
            ]);

            // delete previous image
            Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_mobile_banner);

            $tablet_filename_withext = $validated['offer_tablet_image']->getClientOriginalName();
            $tablet_filename = explode('.', $tablet_filename_withext)[0];
            $tablet_extension = $request->offer_tablet_image->extension();
            Storage::put('public/recycle_offers_images/'.$tablet_filename.".".$tablet_extension, file_get_contents($request->offer_tablet_image));
            
            $tabletBannerImageWithExt = $tablet_filename.".".$tablet_extension;
        }

        // mobile banner
        if($request->file('offer_mobile_image')) {
            // validation
            $validated = $request->validate([
                'offer_mobile_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'device' => 'required',
            ]);

            // delete previous image
            Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_mobile_banner);

            $mobile_filename_withext = $validated['offer_mobile_image']->getClientOriginalName();
            $mobile_filename = explode('.', $mobile_filename_withext)[0];
            $mobile_extension = $request->offer_mobile_image->extension();
            Storage::put('public/recycle_offers_images/'.$mobile_filename.".".$mobile_extension, file_get_contents($request->offer_mobile_image));
            
            $mobileImageWithExt = $mobile_filename.".".$mobile_extension;
        }

        // selling banner
        if($request->file('offer_selling_banner_image')) {
            // validation
            $validated = $request->validate([
                'offer_selling_banner_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'device' => 'required',
            ]);

            // delete previous image
            Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_selling_banner);

            if($request->file('offer_selling_banner_image')->isValid()) {
                $banner_filename_withext = $validated['offer_selling_banner_image']->getClientOriginalName();
                $banner_filename = explode('.', $banner_filename_withext)[0];
                $banner_extension = $request->offer_selling_banner_image->extension();
                Storage::put('public/recycle_offers_images/'.$banner_filename.".".$banner_extension, file_get_contents($request->offer_selling_banner_image));
            }
            
            $sellBannerImageWithExt = $banner_filename.".".$banner_extension;
        }

        // selling tablet banner
        if($request->file('offer_selling_banner_tablet_image')){
            // validation
            $validated = $request->validate([
                'offer_selling_banner_tablet_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'device' => 'required',
            ]);

            Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_selling_banner_tablet_image);

            if($request->file('offer_selling_banner_tablet_image')->isValid()) {
                $tablet_banner_filename_withext = $validated['offer_selling_banner_tablet_image']->getClientOriginalName();
                $tablet_banner_filename = explode('.', $tablet_banner_filename_withext)[0];
                $tablet_banner_extension = $request->offer_selling_banner_tablet_image->extension();
                Storage::put('public/recycle_offers_images/'.$tablet_banner_filename.".".$tablet_banner_extension, file_get_contents($request->offer_selling_banner_tablet_image));
            }
            $tablet_sellBannerImageWithExt = $tablet_banner_filename.".".$tablet_banner_extension;

        }

        // selling mobile banner
        if($request->file('offer_selling_banner_mobile_image')){
            // validation
            $validated = $request->validate([
                'offer_selling_banner_mobile_image' => 'required|mimes:jpeg,png,svg|max:10000',
                'device' => 'required',
            ]);

            Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_selling_banner_mobile_image);

            if($request->file('offer_selling_banner_mobile_image')->isValid()) {
                $mobile_banner_filename_withext = $validated['offer_selling_banner_mobile_image']->getClientOriginalName();
                $mobile_banner_filename = explode('.', $mobile_banner_filename_withext)[0];
                $mobile_banner_extension = $request->offer_selling_banner_mobile_image->extension();
                Storage::put('public/recycle_offers_images/'.$mobile_banner_filename.".".$mobile_banner_extension, file_get_contents($request->offer_selling_banner_mobile_image));
            }
            $mobile_sellBannerImageWithExt = $mobile_banner_filename.".".$mobile_banner_extension;

        }

        // validation
        $validated = $request->validate([
            'device' => 'required',
        ]);
    
        $recycleOffer->update([
            'device_id' => $request->device,
            // 'offer_title' => $request->offer_title,
            // 'offer_description' => $request->offer_description,
            // 'offer_additional_info' => $request->offer_additional_info,
            // 'offer_price' => $request->offer_price,
            // 'offer_start_date' => Carbon::parse($request->offer_start_date),
            // 'offer_end_date' => Carbon::parse($request->offer_end_date)
        ]);

        if($imageWithExt){
            $recycleOffer->offer_banner = $imageWithExt;
            $recycleOffer->save();
        }

        if($tabletBannerImageWithExt){
            $recycleOffer->offer_tablet_banner = $tabletBannerImageWithExt;
            $recycleOffer->save();
        }

        if($mobileImageWithExt){
            $recycleOffer->offer_mobile_banner = $mobileImageWithExt;
            $recycleOffer->save();
        }

        if($sellBannerImageWithExt){
            $recycleOffer->offer_selling_banner = $sellBannerImageWithExt;
            $recycleOffer->save();
        }

        if($tablet_sellBannerImageWithExt){
            $recycleOffer->offer_selling_tablet_banner = $tablet_sellBannerImageWithExt;
            $recycleOffer->save();
        }

        if($mobile_sellBannerImageWithExt){
            $recycleOffer->offer_selling_mobile_banner = $mobile_sellBannerImageWithExt;
            $recycleOffer->save();
        }

        return redirect('/portal/recycleoffers')->with('success', 'Recycle offer updated successfully.');
    }

    public function activateRecycleOffer($id){
        $recycleOffer = RecycleOffer::findOrFail($id);
        $activeOffers = RecycleOffer::where('status', 1)->get();

        foreach($activeOffers as $activeOffer){
            $activeOffer->status = false;
            $activeOffer->save();
        }
        $action = null;
        if(!$recycleOffer->status){
            $action = 'enabled';
            $recycleOffer->status = true;
        } else {
            $action = 'disabled';
            $recycleOffer->status = false;
        }
        $recycleOffer->save();

        return redirect('/portal/recycleoffers')->with('info', 'Recycle offer for '.$recycleOffer->getDevice(). ' ' . $action .  '.');
    }

    public function deleteOffer($id){
        $recycleOffer = RecycleOffer::findOrFail($id);
        Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_banner);
        Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_tablet_banner);
        Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_mobile_banner);
        Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_selling_banner);
        Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_selling_tablet_banner);
        Storage::delete('public/recycle_offers_images/'.$recycleOffer->offer_selling_banner_mobile_image);
        $recycleOffer->delete();
        return redirect()->back()->with('success', 'Recycle offer deleted successfully.');
    }
}
