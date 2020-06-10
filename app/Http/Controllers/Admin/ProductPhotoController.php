<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    
    
       public function removePhoto(Request $request)
    
        {
            $photoName = $request->get('photoName');  
        //Verifica se a imagen existe na pasta public
        if(Storage::disk('public')->exists($photoName)){

            Storage::disk('public')->delete($photoName);
        }
    
        //Remova o imagem na BD
        $removePhoto = ProductPhoto::where('image',$photoName);
        
        $productId =  $removePhoto->first()->product_id;
        
        $removePhoto->delete();

        flash('<i class="far fa-check-circle fa-lg pr-2"></i>Foto removido com sucesso')->success();
       
        return redirect()->route('admin.products.edit', ['product' =>$productId]);

         
        }
    
    
}
