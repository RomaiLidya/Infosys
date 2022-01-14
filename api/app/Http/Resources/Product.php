<?php

namespace App\Http\Resources;

use App\Models\Product as ProductApp;
use App\Models\StockItem;
use Aws\S3\S3Client;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class Product extends JsonResource
{
    public function foo($value)
    {
        $this->foo = $value;
        return $this;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = collect($this->productImages)->map(function ($collection, $key) {
            $collect = (object) $collection;

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
                'Key' => env('APP_ENV') . '/' . $collect->path,
            ];

            $cmd = $s3Client->getCommand('GetObject', $options);

            if (!empty($this->foo) && $this->foo === 'create') {
                $cmd = $s3Client->getCommand('PutObject', $options);
            }

            $request = $s3Client->createPresignedRequest($cmd, '+20 minutes');
            $presignedUrl = (string) $request->getUri();

            $collect->url = $presignedUrl;
            return $collect;
        });

        $productPrice = $this->productPrices;


        if ($this->isProductPackage && $this->productPackage !== null) {
            $productPrice[] = [
                'id' => 0,
                'price' => $this->productPackage->totalPrice,
                'ZoneId' => $this->productPackage->ZoneId,
                'Zone' => new Zone($this->productPackage->zone),
            ];
        }

        if ($request->has('route')) {
            if ($this->isProductPackage && $this->productPackage !== null) {
                $route = array_map('intval', explode(',', $request->query('route')));
                $productPrice = in_array($this->productPackage->ZoneId, $route) ? $productPrice : [];
            } else {
                $productPrice = $this->productPrices()
                ->join('Zone', 'Zone.id', '=', 'ProductPrice.ZoneId')
                ->where('ProductPrice.isDeleted', false)
                ->whereIn('ZoneId', array_map('intval', explode(',', $request->query('route'))))
                ->orderBy('Zone.name', 'ASC')
                ->get();
            }
        }

        return [
            'id' => $this->id,
            'productName' => $this->productName,
            'productCode' => $this->productCode,
            'sellingPrice' => (int) $this->sellingPrice,
            'purchasePrice' => (int) $this->purchasePrice,
            'typeUnit' => $this->typeUnit,
            'description' => $this->description,
            'isReminder' => (boolean) $this->isReminder,
            'minimumStock' => (int) $this->minimumStock,
            'isProductPackage' => (boolean) $this->isProductPackage,
            'Category' => new Category($this->category),
            'ProductPackage' => new ProductPackage($this->when($this->isProductPackage, $this->productPackage)),
            'ProductImages' => new ProductImagesCollection($data),
            'ProductImage' => count($data) > 0 ? new ProductImages($data[0]) : '',
            'ProductPrice' => $this->isProductPackage ? $productPrice : new ProductPriceCollection($productPrice),
            'warehouse' => $this->warehouse !== null ? $this->warehouse->name : '',
            'WareHouseId' => (int) $this->WareHouseId,
            'totalDamage' => (int) $this->totalDamage,
            'new' => (date_diff(date_create(date('Y-m-d', strtotime($this->createdAt))), date_create(date('Y-m-d'))))->format('%a') <= 30
        ];
    }
}
