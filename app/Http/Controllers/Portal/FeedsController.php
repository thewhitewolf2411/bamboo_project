<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DNS1D;
use DNS2D;
use PDF;
use File;
use DB;
use Schema;
use App\Eloquent\PortalUsers;
use App\Eloquent\Category;
use App\Eloquent\Brand;
use App\Eloquent\Network;
use App\Eloquent\SellingProduct;
use App\Eloquent\ProductInformation;
use App\Eloquent\ProductNetworks;
use App\Eloquent\Colour;
use App\Eloquent\BuyingProduct;
use App\Eloquent\BuyingProductColours;
use App\Eloquent\BuyingProductInformation;
use App\Eloquent\BuyingProductNetworks;
use App\Eloquent\Feed;

class FeedsController extends Controller
{
    

    public function showFeedsPage(){
        //if(!$this->checkAuthLevel(8)){return redirect('/');}

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.feeds.feeds')->with('portalUser', $portalUser);
    }

    public function showExportImportPage(){
        //if(!$this->checkAuthLevel(8)){return redirect('/');}
        $categories = Category::all();
        $brands = Brand::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.feeds.export-import')->with(['categories'=>$categories, 'brands'=>$brands, 'portalUser'=>$portalUser]);
    }

    public function showFeedsSummaryPage(){
        //if(!$this->checkAuthLevel(8)){return redirect('/');}
        $feeds = Feed::all();

        $user_id = Auth::user()->id;
        $portalUser = PortalUsers::where('user_id', $user_id)->first();

        return view('portal.feeds.summary')->with('feeds', $feeds)->with('portalUser', $portalUser);
    }

    public function feedsExport(Request $request){

        $export_feed_parameter = $request->export_feed_parameter;

        $columns = "";
        $datarows = "";
        $products = "";

        if($export_feed_parameter == 1){
            $columns = Schema::getColumnListing('buying_products');
            //28 
            $datarows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z', 'AA'];
            $products = BuyingProduct::all();
        }
        else if($export_feed_parameter == 2){
            $columns = Schema::getColumnListing('selling_products'); 
            $products = SellingProduct::all();
            $datarows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I','J','K','L','M','N','O','P','R'];
        }
        
        $filename = "/feed_type_".$export_feed_parameter." " . date("Y-m-d") ."_". date("h-i-s") . ".xlsx";

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        #dd($datarows);
        if($export_feed_parameter == 1){
            for($i=0; $i<count($datarows); $i++){
                #dd($datarows);
                $sheet->setCellValue($datarows[$i] . "1", $columns[$i]);
            }
            foreach($products as $key=>$product){
                $product = array_values($product->toArray());
                
                for($i=0; $i<count($product); $i++){
                    $sheet->setCellValue($datarows[$i] . ($key+2), $product[$i]);
                }
            }
        }
        else{
            $k = 2;
            for($i=0; $i<count($columns)-3; $i++){
                $sheet->setCellValue($datarows[$i] . "1", $columns[$i]);

                $sheet->setCellValue('F1', 'product_memory');
                $sheet->setCellValue('G1', 'excellent_working');
                $sheet->setCellValue('H1', 'good_working');
                $sheet->setCellValue('I1', 'poor_working');
                $sheet->setCellValue('J1', 'damaged_working');
                $sheet->setCellValue('K1', 'faulty');

                $sheet->setCellValue('L1', 'avaliable_for_sell');
                // $sheet->setCellValue('M1', 'created_at');
                // $sheet->setCellValue('N1', 'updated_at');
                $sheet->setCellValue('M1', 'product_network');
                $sheet->setCellValue('N1', 'product_network_price');
                $sheet->setCellValue('O1', 'product_available_colours');
            }
            foreach($products as $key=>$product){
                $product = array_values($product->toArray());
                $productInformation = ProductInformation::where('product_id', $product[0])->get();
                $productNetworks = ProductNetworks::where('product_id', $product[0])->get();
                $productColor = Colour::where('product_id', $product[0])->get();


                $sheet->setCellValue('B' . $k, $product[1]);
                $sheet->setCellValue('C' . $k, $product[2]);
                $sheet->setCellValue('D' . $k, $product[3]);
                $sheet->setCellValue('E' . $k, $product[4]);
                $sheet->setCellValue('L' . $k, $product[6]);
                $sheet->setCellValue('M' . $k, $product[7]);
                $sheet->setCellValue('N' . $k, $product[8]);

                $sheet->setCellValue('M' . $k, '');
                $sheet->setCellValue('N' . $k, '');

                $i=$k;
                foreach($productInformation as $productInfo){
                    $sheet->setCellValue('F'.$i, $productInfo->memory);
                    $sheet->setCellValue('G'.$i, $productInfo->excellent_working);
                    $sheet->setCellValue('H'.$i, $productInfo->good_working);
                    $sheet->setCellValue('I'.$i, $productInfo->poor_working);
                    $sheet->setCellValue('J'.$i, $productInfo->damaged_working);
                    $sheet->setCellValue('K'.$i, $productInfo->faulty);

                    $i++;
                }

                $i=$k;
                foreach($productNetworks as $network){
                    $sheet->setCellValue('M'.$i, $network->getNetWorkName($network->network_id));
                    $sheet->setCellValue('N'.$i, $network->knockoff_price);
                    $i++;
                }

                $i=$k;
                foreach($productColor as $color){
                    $sheet->setCellValue('O'.$i, $color->color_value);
                    $i++;
                }
            

                if(count($productNetworks) >= count($productColor)){
                    $k += count($productNetworks) + 1;
                }
                else{
                    $k += count($productColor) + 1;
                }
            }
        }




        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); 
        $writer->save(public_path() . "/" . $filename);
        
        $this->downloadFile(public_path() . "/" . $filename);
        

    }

    public function downloadBulk($file){
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);

            // if file is downloaded delete all created files from the sistem
            File::delete($file);
        }
    }

    public function downloadFile($file){
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            // if file is downloaded delete all created files from the sistem
            File::delete($file);
            return \redirect()->back()->with('success','You have succesfully exported products.');
        }
    }

    public function downloadSingleFile(Request $request){

        return response(['code'=>200, 'filename'=>$request->file . ".pdf"]);

    }


    public function feedsImport(Request $request){

        $export_feed_parameter = $request->export_feed_parameter;

        $products = "";
        $productInformation = "";

        # export feed parameters:
        # 1. - Sales products (SellingProduct model)
        # 2. - Recycle products (BuyingProduct model)

        if($export_feed_parameter == 1){
            DB::table('buying_products')->truncate();
            DB::table('buying_products_colours')->truncate();
            DB::table('buying_product_information')->truncate();
            DB::table('buying_product_network')->truncate();
        }
        else if($export_feed_parameter == 2){
            DB::table('selling_products')->truncate();
            DB::table('product_information')->truncate();
            DB::table('product_networks')->truncate();
            DB::table('colours')->truncate();
        }

        $inputFileName = $request->file('imported_csv')->getClientOriginalName();
        $inputFileType = 'Xlsx';

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Advise the Reader that we only want to load cell data  **/
        $reader->setReadDataOnly(true);

        $worksheetData = $reader->listWorksheetInfo($request->file('imported_csv'));
        $worksheetData = $worksheetData[0];

        $sheetName = $worksheetData['worksheetName'];
        $reader->setLoadSheetsOnly($sheetName);
        $spreadsheet = $reader->load($request->file('imported_csv'));
        $worksheet = $spreadsheet->getActiveSheet();

        $importeddata = $worksheet->toArray();

        #dd($importeddata, $networks);

        $file_header = $importeddata[0];

        if($importeddata[0][0]==='id'){
            unset($importeddata[0]);
        }
        $importeddata = array_values($importeddata);

        if($export_feed_parameter == 1){

            // check if there are enoguh fields
            if(count($file_header) < 28){
                return \redirect()->back()->with('error','Error - check your import file.');
            }

            $networks = Network::all();

            $emptyrows = array();

            $k = count($importeddata[0]);

            foreach($importeddata as $key=>$row){

                if($row[1] !== null){

                    $product = new BuyingProduct();
                    $product->product_name = $row[1];
                    $product->product_image = 'default_image';
                    $product->category_id = $row[3];
                    $product->brand_id = $row[4];
                    $product->product_description = $row[5];

                    
                    if($row[15] !== null){
                        $product->product_dimensions = $row[15];
                    }
                    if($row[16] !== null){
                        $product->product_processor = $row[16];
                    }
                    if($row[17] !== null){
                        $product->product_weight = $row[17];
                    }
                    if($row[18] !== null){
                        $product->product_screen = $row[18];
                    }
                    if($row[19] !== null){
                        $product->product_system = $row[19];
                    }
                    if($row[20] !== null){
                        $product->product_connectivity = $row[20];
                    }
                    if($row[21] !== null){
                        $product->product_battery = $row[21];
                    }
                    if($row[22] !== null){
                        $product->product_signal = $row[22];
                    }
                    if($row[23] !== null){
                        $product->product_camera = $row[23];
                    }
                    if($row[24] !== null){
                        $product->product_camera_2 = $row[24];
                    }
                    if($row[25] !== null){
                        $product->product_sim = $row[25];
                    }
                    if($row[26] !== null){
                        $product->product_memory_slots = $row[26];
                    }

                    $product->save();
                }

                if($importeddata[$key][6] !== null){
                    $buyingProductInformation = new BuyingProductInformation();
                    $buyingProductInformation->product_id = $product->id;
                    $buyingProductInformation->memory = $importeddata[$key][6];
                    $buyingProductInformation->excellent_working = $importeddata[$key][7];
                    $buyingProductInformation->good_working = $importeddata[$key][8];
                    $buyingProductInformation->poor_working = $importeddata[$key][9];
                    $buyingProductInformation->save();
                }

                foreach($networks as $network){
                    if($importeddata[$key][12] !== null && $network->network_name == $importeddata[$key][12]){
                        $productNetworks = new BuyingProductNetworks();
                        $productNetworks->network_id = $network->id;
                        $productNetworks->product_id = $product->id;
                        $productNetworks->knockoff_price = $importeddata[$key][13];
                        $productNetworks->save();
                    }
                }   

                $feed = new Feed();
                $feed->feed_type = "All buying devices";
                $feed->status = "Done";
                $feed->save();
            }
        }
        else if($export_feed_parameter == 2){

            // ignore 12 & 13 (created_at and updated_at) index at

            // required fields for importing Recycle products
            $required_product_fields = ['product_name', 'product_image', 'category_id', 'brand_id'];
            // if memory, then these required
            $required_product_info_fields = ['product_memory', 'excellent_working', 'good_working', 'poor_working', 'damaged_working', 'faulty'];

            // if network id, then these are required
            $required_product_network_fields = ['product_network', 'product_network_price', 'product_available_colours'];

            $missing_header_fields = [];

            // check product required fields
            foreach($required_product_fields as $f){
                if(!in_array($f, $file_header)){
                    array_push($missing_header_fields, $f);
                }
            }

            // check product info header fields
            foreach($required_product_info_fields as $pi){
                if(!in_array($pi, $file_header)){
                    array_push($missing_header_fields, $pi);
                }
            }

            // check product network header fields
            foreach($required_product_network_fields as $pnf){
                if(!in_array($pnf, $file_header)){
                    array_push($missing_header_fields, $pnf);
                }
            }


            if(count($missing_header_fields) > 0){
                return \redirect()->back()->with('error','Error - check your import file. Missing fields: ' . implode(', ', $missing_header_fields));
            }

            $networks = Network::all();

            $emptyrows = array();

            $k = count($importeddata[0]);
            
            // messages to display after failed/skipped imports
            $export_log = [];

            foreach($importeddata as $key=>$row){
                if($row[1] !== null){
                    $valid_product = false;
                    // validate selling product data
                    if(isset($row[1]) && isset($row[3]) && isset($row[4])){
                        $valid_product = true;
                    }
                    if($valid_product){
                        $sellingProduct = new SellingProduct();
                        $sellingProduct->product_name = $row[1];
                        $sellingProduct->product_image = 'default_image';
                        $sellingProduct->category_id = $row[3];
                        $sellingProduct->brand_id = $row[4];
                        $sellingProduct->save();   
                    } else {
                        $missing = [];
                        if(!isset($row[1])) { array_push($missing, $file_header[1]); }
                        if(!isset($row[3])) { array_push($missing, $file_header[3]); }
                        if(!isset($row[4])) { array_push($missing, $file_header[4]); }
    
                        if(count($missing) < 2){
                            array_push($export_log, "Missing Selling Product " .  $missing[0]);
                        } else {
                            array_push($export_log, "Missing Selling Product: " . implode(', ', $missing));
                        }
                    }
                } 

                // check if product info data is valid
                $valid_product_info = false;
                if(isset($row[5]) && isset($row[6]) && isset($row[7]) && isset($row[8]) && isset($row[9]) && isset($row[10])){
                    $valid_product_info = true;
                }

                // if memory is present, store product information
                if($importeddata[$key][5] !== null){
                    if($valid_product_info){
                        $sellingProductInformation = new ProductInformation();
                        $sellingProductInformation->product_id = $sellingProduct->id;
                        $sellingProductInformation->memory = $importeddata[$key][5];
                        $sellingProductInformation->excellent_working = $importeddata[$key][6];
                        $sellingProductInformation->good_working = $importeddata[$key][7];
                        $sellingProductInformation->poor_working = $importeddata[$key][8];
                        $sellingProductInformation->damaged_working = $importeddata[$key][9];
                        $sellingProductInformation->faulty = $importeddata[$key][10];
                        $sellingProductInformation->save();
                    } else {
                        $missing = [];
                        if(!isset($row[5])) { array_push($missing, $file_header[5]); }
                        if(!isset($row[6])) { array_push($missing, $file_header[6]); }
                        if(!isset($row[7])) { array_push($missing, $file_header[7]); }
                        if(!isset($row[8])) { array_push($missing, $file_header[8]); }
                        if(!isset($row[9])) { array_push($missing, $file_header[9]); }
                        if(!isset($row[10])) { array_push($missing, $file_header[10]); }

    
                        if(count($missing) < 2){
                            array_push($export_log, "Missing Selling Product [" . $sellingProduct->product_name . "] info: " .  $missing[0]);
                        } else {
                            array_push($export_log, "Missing Selling Product [" . $sellingProduct->product_name . "] info: " . implode(', ', $missing));
                        }
                    }
                }

                foreach($networks as $network){

                    // if network is present and valid, add product network
                    if($importeddata[$key][12] !== null && $network->network_name == $importeddata[$key][12]){

                        // check if product network info is valid
                        $valid_network_info = false;
                        if(isset($row[13])){
                            $valid_network_info = true;
                        }

                        if($valid_network_info){
                            $productNetworks = new ProductNetworks();
                            $productNetworks->network_id = $network->id;
                            $productNetworks->product_id = $sellingProduct->id;
                            $productNetworks->knockoff_price = $importeddata[$key][13];
                            $productNetworks->save();
                        } else {
                            array_push($export_log, "Missing Selling Product [" . $sellingProduct->product_name . "] network [" . $network->network_name . "] info: " . $file_header[15]);
                        }

                        
                    }
                }

                // check if product color info is valid
                if($importeddata[$key][14] !== null){

                    $productColours = new Colour();
                    $productColours->product_id = $sellingProduct->id;
                    $productColours->color_value = $importeddata[$key][14];
                    $productColours->save(); 
                    
                }


            }

            if(!empty($export_log)){
                array_push($export_log, 'You have succesfully imported products.');
                return \redirect()->back()->with('failed-info', $export_log);
            }
     
        }
        else{
            return \redirect()->back()->with('error','Something went wrong, please try again.');
        }
        return \redirect()->back()->with('success','You have succesfully imported products.');
    }
}
