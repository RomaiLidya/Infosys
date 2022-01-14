interface ProductItemModel {
  id?: number;
  ProductId: number;
  minimumItem?: number;
  bonusItem?: number;
  promoPrice: number;
  ProductPackageId?: number;
  Product?: ProductModel;
  isDeleted?: boolean;
}
