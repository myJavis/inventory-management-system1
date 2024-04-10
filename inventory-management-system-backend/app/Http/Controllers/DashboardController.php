<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardData(Request $request)
    {
        $newProductsCount = Product::whereDate('created_at', today())->count();
        $totalProductsCount = Product::count();
        $totalCategoriesCount = Category::count();
        $totalUsersCount = User::count();

        // Return the data as JSON response
        return response()->json([
            'newProductsCount' => $newProductsCount,
            'totalProductsCount' => $totalProductsCount,
            'totalCategoriesCount' => $totalCategoriesCount,
            'totalUsersCount' => $totalUsersCount,
        ]);
    }
}
