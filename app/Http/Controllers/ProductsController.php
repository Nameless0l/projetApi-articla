<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//Nous allons créer les fonctions suivantes: index, show,

class ProductsController extends Controller
{
    /**
     * afficher tout les produits
     */
    public function index()
    {
        $product=Products::all();
        if(count($product)==0)
        {
            return response()->json(['statut'=>404,'message'=>'any group is already added'],404);
        }
        return response()->json([$product,'status'=>200,'message'=>'done'],200);

    }

     /**
   * Affiche les détails d'un produit spécifique.
   *
   * @param  string  $id  Identifiant unique du produit
   * @return \Illuminate\Http\Response
   */
    public function show(string $id)
    {
        try {
            $product=Products::findorFail($id);
            return response()->json(['status'=>200,'product'=>$product,'messages'=>'done']);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(['message'=>'produit non trouvé'],404);
        }
    }

    /**
     * Enregistrer un nouveau produit
     */
    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),
            [
                //mettre vos retrictions sur les donnés entrée par l'utilisateur  ici
            ]);


        if($validator->fails())
            {
                return response()->json([
                    'status'=>422,
                    'errors'=>$validator->messages()
                ],422);
            }
        else
        {

            $product=Products::create([
                'name'=>$request->input('name'),
                'brandName'=>$request->brandName,
                'description'=>$request->description,
                'price'=>$request->price,
                'inPromotion'=>$request->inPromotion,
                'imagePath'=>$request->imagePath,
                ]);
            if($product)
            {
                return response()->json(
                    [
                        'statut'=>200,
                        'message'=>'done',
                        'product'=>$product
                    ]
                    );
            }else
            {
                return response()->json(
                    [
                        'statut'=>500,
                        'message'=>'serveur error'
                    ]
                    );
            }
        }
    }


    /**
     * Modifier un produit existant
     */
    public function update(Request $request, string $id)
    {
        $validator= Validator::make($request->all(),
        [
            //mettre vos retrictions sur les donnés entrée par l'utilisateur  ici
        ]);
        if($validator->fails())
            {
                return response()->json([
                    'status'=>422,
                    'errors'=>$validator->messages()
                ],422);
            }
        else
        {

            $product=Products::findorFail($id);

            if($product)
            {
                $product->update([
                    'name'=>$request->name,
                    'brandName'=>$request->brandName,
                    'description'=>$request->description,
                    'price'=>$request->price,
                    'inPromotion'=>$request->inPromotion,
                    'imagePath'=>$request->imagePath,
                ]);
                return response()->json(
                    [
                        'statut'=>200,
                        'message'=>'updated',
                        'product'=>$product
                    ]
                    );
            }else
            {
                return response()->json(
                    [
                        'statut'=>500,
                        'message'=>'server error'
                    ]
                    );
            }
        }
}

    /**
     * supprimer un produit existant
     */
    public function destroy(string $id)
        {
            try {
                $product=Products::findorFail($id);
                $product->delete();
                return response()->json(['status'=>200,$product,'messages'=>'done']);
            } catch (Exception $errors)
            {
                $errors = 'Not found';
                return response()->json($errors,404);
            }

        }
}
