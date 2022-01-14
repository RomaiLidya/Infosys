interface ProductPackageModel {
  id: number;
  name: string;
  totalPrice: number;
  description: string;
  Zone?: ZoneModel;
  ProductItem?: ProductItemModel[];
}
