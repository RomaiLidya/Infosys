interface ProductModel {
  id: number;
  productName: string;
  productCode: string;
  sellingPrice: number;
  purchasePrice: number;
  typeUnit: string;
  totalStock: number;
  description: string;
  isReminder: boolean;
  minimumStock: number;
  holdItem?:number;
  isProductPackage?: boolean;
  Category?: CategoryModel;
  ProductImage?: ProductImageModel;
  ProductImages?: ProductImageModel[];
  ProductPrice?: ProductPriceModel[];
  ProductPackage?: ProductPackageModel;
  warehouse?: string;
  image: string;
  imageUrl?: string; 
  new?: boolean;
}
