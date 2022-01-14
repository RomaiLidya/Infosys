interface ReturnOrderItemModel {
  id: number;
  SalesOrderId: number;
  ProductId: number;
  typeUnit: string;
  totalItem: number;
  price: number;
  subTotalPrice: number;
  totalPrice: number;
  discount: number;
  status: 'CONFIRM' | 'PENDING' | 'REJECT' | 'HAS_INVOICE';
  notes?: string;
  isDeleted?: boolean;
  deletedAt?: Date;
  Product?: ProductModel;
}
