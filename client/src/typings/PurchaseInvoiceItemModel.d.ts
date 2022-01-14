interface PurchaseInvoiceItemModel {
  id: number;
  PurchaseInvoiceId: number;
  ProductId: number;
  typeUnit: string;
  totalItem: number;
  price: number;
  subTotalPrice: number;
  totalPrice: number;
  discount: number;
  notes?: string;
  isDeleted?: boolean;
  deletedAt?: Date;
  Product?: ProductModel;
}
