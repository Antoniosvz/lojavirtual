<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class ProductsControllerApi extends Controller
{

    public function index()
    {
        $productList = Product::all();
        return response()->json([
            "success" => true,
            "message" => "Lista de produtos",
            "data" => $productList
        ]);
    }

    public function loginapi(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check(
            $request->password,
            $user->password
        )) {
            throw ValidationValidationException::withMessages([
                'email' => ['As credenciais são inválidas.'],
            ]);
        }
        return $user->createToken('token')->plainTextToken;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'quantity' => 'required|gt:0',
            'price' => 'required|gt:0'
        ]);
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'type_id' => $request->type_id
        ]);
        return response()->json([
            "success" => true,
            "message" => "Produto criado com sucesso",
            "data" => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "Produto não encontrado"
            ], 404);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                "success" => false,
                "message" => "Produto não encontrado"
            ], 404);
        }

        $product->delete();
        return response()->json([
            "success" => true,
            "message" => "Produto excluído com sucesso"
        ]);
    }
}
