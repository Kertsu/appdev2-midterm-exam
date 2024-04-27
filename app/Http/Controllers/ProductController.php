<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\ProductAccessMiddleware;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware(ProductAccessMiddleware::class)->except('index', 'show');
    }
    /**
     * ○ Retrieving a list of all products.
     *       i. Response message: Display all products.
     */
    public function index()
    {
        return response()->json([
            "message" => "Display all products."
        ]);
    }

    /**
     * ○ Creating a new product.
     *      i. Response Message: Product created successfully.
     */
    public function store(Request $request)
    {
        return response()->json([
            "message" => "Product created successfully."
        ]);
    }

    /**
     *Retrieving a specific product by ID.
     *       i. Response Message: 
     */
    public function show(string $id)
    {
        return response()->json([
            "message" => "Display product with ID: " . $id
        ]);
    }

    /**
     * ○ Updating an existing product by ID.
     *      i. Response Message: Product with ID: <id> updated successfully.
     */
    public function update(Request $request, string $id)
    {
        return response()->json([
            "message" => "Product with ID: " . $id. " updated successfully."
        ]);
    }

    /**
     *○ Deleting a product by ID.
     *      i. Response Message: Product with ID: <id> deleted successfully.
     */
    public function destroy(string $id)
    {
        return response()->json([
            "message" => "Product with ID: " . $id. " deleted successfully."
        ]);
    }

    /**
     * Add a new method uploadImageLocal to handle uploading an image using the local disk driver.
     *   i. Response Message: Image successfully stored in local disk driver.
     */
    public function uploadImageLocal(Request $request){
        if ($request->hasFile('image')){
            Storage::disk('local')->put('/', $request->file('image'));

            return response()->json([
                "message" => "Image successfully stored in local disk driver."
            ]);
        }

        return response()->json([
            "error" => "There was an error in uploading the image."
        ], 400);
        
    }

    /**
     * ○ Add another method uploadImagePublic to handle uploading an image using the public disk driver.
     *   i. Response Message: Image successfully stored in public disk driver.
     */
    public function uploadImagePublic(Request $request){
        if ($request->hasFile('image')){
            Storage::disk('public')->put('/', $request->file('image'));

            return response()->json([
                "message" => "Image successfully stored in public disk driver."
            ]);
        }

        return response()->json([
            "error" => "There was an error in uploading the image."
        ], 400);
    }
}
