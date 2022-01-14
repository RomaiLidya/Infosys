interface PurchaseOrderItemModel {
  id: number;
  PurchaseOrderId: number;
  ProductId: number;
  typeUnit: string;
  totalItem: number;
  price: number;
  subTotalPrice: number;
  totalPrice: number;
  discount: number;
  status: 'CONFIRM' | 'PENDING' | 'REJECT';
  notes?: string;
  isDeleted?: boolean;
  deletedAt?: Date;
  Product?: ProductModel;
}
