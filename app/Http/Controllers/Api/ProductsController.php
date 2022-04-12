<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\Api;
use App\Models\products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
  
use App\Traits\GeneralTrait;

class ProductsController extends Controller 
{  use GeneralTrait;
   
    public function index()
    {
        $products = products::all();
    // return response()->json($products);
    return $this->returnData('Products',$products,'this is the Products,you want one ? ');
    }
    public function get_pro_byId(Request $request){
        $product = products::get()->find($request->id);
        if(!$product){
            return $this->returnError('001','this product is not found');
        }
     return response()->json($product);
    }
    public function ChangeStatut(Request $request){
        $product = products::where('id',$request->id)->update(['statut'=>$request->statut]);
        return $this->returnSuccessMessage('update succeful');
    }
      
}

