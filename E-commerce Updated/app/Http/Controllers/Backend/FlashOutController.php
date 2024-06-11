<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashOutItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\FlashOutItem;
use App\Models\Product;
use Illuminate\Http\Request;

class FlashOutController extends Controller
{
    public function index(FlashOutItemDataTable $dataTable)
    {
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        return $dataTable->render('Staff.flash-out.index', compact('products'));
    }



    public function addProduct(Request $request)
    {
        $request->validate([
            'product' => ['required', 'unique:flash_out_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ],[
            'product.unique' => 'The product is already in flash out!'
        ]);

        $flashOutItem = new FlashOutItem();
        $flashOutItem->product_id = $request->product;
        $flashOutItem->show_at_home = $request->show_at_home;
        $flashOutItem->status = $request->status;
        $flashOutItem->save();


        $product = Product::findOrFail($request->product);

        $product->product_type = 'flashout_product';
        $product->save();

        toastr('Product Added Successfully!', 'success', 'Success');

        return redirect()->back();

    }

    public function changeShowAtHomeStatus(Request $request)
    {
        $flashOutItem = FlashOutItem::findOrFail($request->id);
        $flashOutItem->show_at_home = $request->status == 'true' ? 1 : 0;
        $flashOutItem->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function changeStatus(Request $request)
    {
        $flashOutItem = FlashOutItem::findOrFail($request->id);
        $flashOutItem->status = $request->status == 'true' ? 1 : 0;
        $flashOutItem->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function destory(string $id)
    {
        $flashOutItem = FlashOutItem::findOrFail($id);
        $flashOutItem->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function getProductsForDropdown(Request $request)
    {
        $search = $request->input('q');

        $products = Product::where('name', 'like', "%{$search}%")->get(['id', 'name']);

        return response()->json($products);
    }
}
