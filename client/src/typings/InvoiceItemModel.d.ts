interface InvoiceItemModel {
  id: number;
  InvoiceId: number;
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
  warehouse?: string;
  createdAt?: string;
}
