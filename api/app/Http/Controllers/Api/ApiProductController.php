<?php

namespace App\Http\Controllers\Api;

use App\Hady\Repository\Finder\ProductFinder;
use App\Hady\Repository\Product as RepositoryProduct;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ResourcesProduct;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\ProductImages;
use App\Models\Company; 
use App\Models\Category; 
use Aws\S3\S3Client;


class ApiProductController extends Controller
{
    public function index(Request $request): ResourceCollection
    {
        $productFinder = new ProductFinder();

        if ($request->has('keyword')) {
            $productFinder->setKeyword($request->query('keyword'));
        }

        if ($request->has('CategoryId')) {
            $productFinder->setCategory($request->query('CategoryId'));
        }

        if ($request->has('isProductPackage')) {
            $productFinder->setIsProductPackage($request->query('isProductPackage'));
        }

        if ($request->has('perPage')) {
            $productFinder->perPage($request->query('perPage'));
        }

        if ($request->has('orderBy') && $request->has('ordered')) {
            $productFinder->orderBy($request->query('orderBy'), $request->query('ordered'));
        } else {
            $productFinder->orderBy('productName', 'asc');
        }

        if ($request->has('WareHouseId')) {
            $productFinder->withWarehouse($request->query('WareHouseId'));
        }

        if ($request->has('useReturn')) {
            $productFinder->withReturn();
        }
        
        if($request->has('damage')){
            $productFinder->withDamage();
        }

        $productFinder->withDelete();
        $data = $productFinder->get();
        $data->foo = 'test';

        $products = (new ProductCollection($data));

        return $products;
    }

    public function show($id): JsonResource
    {
        return new ResourcesProduct(RepositoryProduct::findOne($id)->getModel());
    }

    public function store(Request $request): JsonResource
    {
        $product = Product::findOrNew($request->id);

        $product->productName = $request->productName;
        $product->productCode = $request->productCode;
        $product->purchasePrice = $request->purchasePrice;
        $product->typeUnit = $request->typeUnit;
        $product->description = $request->description;
        $product->CategoryId = $request->CategoryId;
        $product->isProductPackage = $request->isProductPackage;
        $product->WareHouseId = $request->WareHouseId === 0 ? null : $request->WareHouseId;

        $repo = new RepositoryProduct($product);
        $repo->load($request->input());
        $repo->save();

        $product = (new ResourcesProduct($repo->getModel()))->foo('create');

        return $product;
    }

    public function destroy($id)
    {
        RepositoryProduct::findOne($id)->delete();
        return response()->noContent();
    }

    public function uploadImage(Request $request)
    {
        $file = $request->file('image');
        $name = $request->input('name');

        foreach ($file as $index => $image) {
            Storage::put('images/product/' . $name[$index], File::get($image));
        }
        return response()->noContent();
    }

    public function productCode(Request $request)
    {
        $code = RepositoryProduct::getCode($request->input('CategoryId'));

        return response()->json([
            'code' => $code,
        ]);
    }

    public function deleteImage($id)
    {
        RepositoryProduct::deleteImage($id);
        return response()->noContent();
    }

    public function validateCode(Request $request)
    {
        return response()->json([
            'data' => [
                'validate' => Product::where(['productCode' => $request->input('code'), 'isDeleted' => false])
                    ->when($request->input('id'), function ($query, $id) {
                        if ($id > 0) {
                            $query->where('id', '!=', $id);
                        }
                    })
                    ->exists(),
            ],
        ]);
    }
    public function download(Request $request) 
    {
        ini_set('max_execution_time', 3000);

        $data = Product::select('Product.*', 'Category.name AS categoryName')
        ->leftJoin('Category', 'Category.id', '=', 'Product.CategoryId')
        ->when($request->query('CategoryId'), function($query, $value){
            $query->where('CategoryId', $value);
        })
        ->where('isProductPackage', false)
        ->where('Product.isDeleted', false)
        ->where('Category.isDeleted', false)
        ->get();


        $grouped = collect($data)->groupBy('categoryName');
        $products = $grouped->all();

        foreach($products as $c => $data){
            foreach($data as $idx => $item){
                if(count($item['productImages']) > 0){
                    $images = $item['productImages'][0]['path'];
                    $s3Client = S3Client::factory([
                        'credentials' => [
                            'key' => env('AWS_ACCESS_KEY_ID'),
                            'secret' => env('AWS_SECRET_ACCESS_KEY'),
                        ],
                        'version' => 'latest',
                        'signature_version' => 'v4',
                        'region' => env('AWS_REGION'),
                    ]);
                
                    $options = [
                        'Bucket' => env('AWS_BUCKET'),
                        'Key' => 'dev' . '/' . $images,
                    ];
                
                    $cmd = $s3Client->getCommand('GetObject', $options);
                
                    if (!empty($this->foo) && $this->foo === 'create') {
                        $cmd = $s3Client->getCommand('PutObject', $options);
                    }
                
                    $request = $s3Client->createPresignedRequest($cmd, '+20 minutes');
                    $presignedUrl = (string) $request->getUri();
                    $data[$idx]['productImage'] = $presignedUrl;
                }
           }
        }
       
        $pdf = PDF::loadView('pdf.katalog', [
            'products' => $products,
            'company' => Company::first(),
            'category' => Category::first(),
        ]);

        return $pdf->download('katalog.pdf');
        // return view('pdf.katalog', [
        //     'products' => $products,
        //     'company' => Company::first(),
        //     'category' => Category::first(),
        // ]);
    }

}
 
