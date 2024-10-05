<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{

    //* Creating a new supplier
    // TODO - Add products addition
    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            "name"=> "required",
            "email"=> "required|email",
            "password"=> 'required',
            "contact"=> "required",
            "mobile"=> "required"
        ]);


        if($validator->fails()) {
            $response = [
                'status' => 422,
                'message' => "Validation Error",
                'content' => $validator->messages()
            ];
        } else {

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->password = bcrypt($request->password);
            $supplier->contact = $request->contact;
            $supplier->mobile = $request->mobile;
            $supplier->save();

            $response = [
                'status' => 201,
                'message' => "Created",
                'content' => $supplier
            ];
        }

        return response()->json($response, $response['status']);
        // Should include logic to add the supplies (multiple) to the database
    }


    //* Get all suppliers
    public function getAll() {
        $suppliers = Supplier::all();


        $response = [
            'status' => 200,
            'message' => "Found",
            'content' => $suppliers
        ];

        return response()->json($response, $response['status']);
        // Requires pagination
    }

    //* Get a single supplier
    public function getOne($id) {
        $supplier = Supplier::find($id);

        if($supplier) {
            $response = [
                'status' => 200,
                'message' => "Found",
                'content' => $supplier
            ];
        } else {
            $response = [
                'status' => 404,
                'message' => "Not Found"
            ];
        }

        return response()->json($response, $response['status']);
    }


    //* Update a supplier
    public function update(Request $request, $id) {
        $supplier = Supplier::find($id);

        if($supplier) {
            if($request->name != null) $supplier->name = $request->name;
            if($request->email != null) $supplier->email = $request->email;
            if($request->password != null) $supplier->password = bcrypt($request->password);
            if($request->contact != null) $supplier->contact = $request->contact;
            if($request->mobile != null) $supplier->mobile = $request->mobile;
            $supplier->save();

            $response = [
                'status' => 200,
                'message' => "Updated",
                'content' => $supplier
            ];
        } else {
            $response = [
                'status' => 404,
                'message' => "Supplier not found"
            ];
        }

        return response()->json($response, $response['status']);
    }

    //* Delete a supplier
    public function delete($id) {
        $supplier = Supplier::find($id);

        if($supplier) {
            $supplier->delete();
            $response = [
                'status' => 200,
                'message' => "Deleted"
            ];
        } else {
            $response = [
                'status' => 404,
                'message' => "Supplier not found"
            ];
        }

        return response()->json($response, $response['status']);
    }

    //* Getting all suppliers - paginated
    public function getAllPaginated() {
        $suppliers = Supplier::paginate(10);

        $response = [
            'status' => 200,
            'message' => "Found",
            'content' => $suppliers
        ];

        return response()->json($response, $response['status']);
    }


    //* Search based on the name and the mobile numbers
    public function search(Request $request) {
        $suppliers = Supplier::where('name', 'like', '%'.$request->name.'%')
            ->orWhere('mobile', 'like', '%'.$request->mobile.'%')
            ->get();

        $response = [
            'status' => 200,
            'message' => "Found",
            'content' => $suppliers
        ];

        return response()->json($response, $response['status']);
    }
}
