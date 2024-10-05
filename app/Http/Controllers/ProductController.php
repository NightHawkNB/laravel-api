<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*

* Create a single product with supplier Id
* Create multiple products with supplier Id
* Get all products
* Get products by supplier Id
* Update product with Id
* Delete product with Id

?? - File uploading
?? - Handling multiple product addition

*/

class ProductController extends Controller
{
    //* Add a product
    public function createMultiple(Request $request, ?int $id = null) {

        //? Array for containing all the products
        $products = [];

        foreach ($request->all() as $productData) {
            $product = new Product();
            $product->name = $productData['name'];
            $product->price = $productData['price'];
            $product->quantity = $productData['quantity'];
            $product->image = $productData['image'];
            $product->supplier_id = $id ?? ($request->supplier_id ?? null);

            $validator = Validator::make($product->toArray(), [
                "name" => "required",
                "price" => "required",
                "quantity" => "required",
                // "*.image" => "required"
            ]);

            // TODO - handle image uploading part

            if($validator->fails()) {
                $response = [
                    'status' => 422,
                    'message' => "Validation Error",
                    'content' => $validator->messages()
                ];
                return response()->json($response, $response['status']);
            } else {
                $product->save();
                $products[] = $product;
            }
        }

        $response = [
            'status' => 201,
            'message' => "Created",
            'content' => $products
        ];

        return response()->json($response, $response['status']);
    }

    //* Create a single product
    public function create(Request $request, ?int $id = null) {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "price" => "required",
            "quantity" => "required",
            // "image" => "required"
        ]);

        if($validator->fails()) {
            $response = [
                'status' => 422,
                'message' => "Validation Error",
                'content' => $validator->messages()
            ];
        } else {
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->image = $request->image;
            $product->supplier_id = $id ?? null;

            // TODO - handle image uploading part

            $product->save();

            $response = [
                'status' => 201,
                'message' => "Created",
                'content' => $product
            ];
        }

        return response()->json($response, $response['status']);
    }


    //* Get all products
    public function getAll() {
        $products = Product::all();

        if(sizeof($products) == 0) {
            $response = [
                'status' => 200,
                'message' => "No products listed",
                'content' => []
            ];
        } else {
            $response = [
                'status' => 200,
                'message' => "Found",
                'content' => $products
            ];
        }

        return response()->json($response, $response['status']);
    }


    //* Get products by supplier Id
    public function getBySupplierId(int $id) {
        $products = Product::where('supplier_id', $id)->get();

        if(sizeof($products) == 0) {
            $response = [
                'status' => 200,
                'message' => "No products listed",
                'content' => []
            ];
        } else {
            $response = [
                'status' => 200,
                'message' => "Found",
                'content' => $products
            ];
        }

        return response()->json($response, $response['status']);
    }


    //* Update a product
    public function update(Request $request, int $id) {
        $product = Product::find($id);

        if($product) {
            $product->name = $request->name ?? $product->name;
            $product->price = $request->price ?? $product->price;
            $product->quantity = $request->quantity ?? $product->quantity;
            $product->image = $request->image ?? $product->image;
            $product->supplier_id = $request->supplier_id ?? $product->supplier_id;

            // TODO - handle image uploading part

            $product->save();

            $response = [
                'status' => 200,
                'message' => "Updated",
                'content' => $product
            ];
        } else {
            $response = [
                'status' => 404,
                'message' => "Not Found"
            ];
        }

        return response()->json($response, $response['status']);
    }

    //* Delete a product
    public function delete(int $id) {
        $product = Product::find($id);

        if($product) {
            $product->delete();
            $response = [
                'status' => 200,
                'message' => "Deleted"
            ];
        } else {
            $response = [
                'status' => 404,
                'message' => "Not Found"
            ];
        }

        return response()->json($response, $response['status']);
    }
}
