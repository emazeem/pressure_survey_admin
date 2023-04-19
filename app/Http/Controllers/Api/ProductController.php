<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    //
    use CommonTrait;

    public function store(Request  $request){
        $validators = Validator($request->all(), [
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'area' => 'required',
            'images' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), false);
        }

        $product=new Product();
        $product->title=$request->title;
        $product->description=$request->description;
        $product->user_id=$request->user_id;
        $product->category_id=$request->category_id;
        $product->price=$request->price;
        $product->area=$request->area;
        $product->save();
        foreach ($request->images as $k=>$image){
            $attachment =time().'-'.$k.$image->getClientOriginalExtension();
            Storage::disk('local')->put('/public/products/' . $attachment, File::get($image));
            $productImage=new ProductImage();
            $productImage->product_id=$product->id;
            $productImage->image=$attachment;
            if ($k==$request->is_thumbnail){
                $productImage->is_thumbnail=1;
            }
            $productImage->save();
        }
        return $this->sendSuccess("Product added successfully!",true);
    }
    public function fetch_all(Request  $request){
        $products=Product::with('images');
        if($request->key=='my'){
            $products->where('user_id',Auth::user()->id);
            if($request->only_trash==1){
                $products->onlyTrashed();
            }
        }


        if($request->category){
            $products->where('category_id',$request->category);
        }elseif($request->price){
            $products->orderBy('price',$request->price);
        }elseif($request->time){
            $products->orderBy('created_at',$request->time);
        }
        $products=$products->get();
        return $this->sendSuccess("Products fetched successfully!",$products);

    }
    public function fetch(Request  $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), false);
        }

        $product=Product::with('images')->where('id',$request->id)->first();
        $now = Carbon::now();
        $created = new Carbon($product->created_at);;
        $product['ago']=$created->diffForHumans($now);
        return $this->sendSuccess("Product fetched successfully!",$product);

    }

    public function categories(Request  $request){
        $categories=ProductCategory::all();
        return $this->sendSuccess("Categories fetched successfully!",$categories);
    }
    public function delete(Request  $request){
        $validators = Validator($request->all(), [
            'id' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), false);
        }
        $product=Product::find($request->id);
        if($product->user_id==Auth::user()->id){
            $product->delete();
        }
        return $this->sendSuccess("Product deleted successfully!",true);
    }
}
