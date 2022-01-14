interface PurchaseInvoiceModel {
  id: number;
  invoiceNumberSupplier: string;
  invoiceNumber: string;
  PartnerId: number;
  dueDate: Date;
  orderDate: Date;
  paidDate?: Date;
  totalItem: number;
  totalPrice: number;
  totalDiscount: number;
  totalPay: number;
  totalReturn?: number;
  totalInvoice?: number;
  statusPayment: 'PAID' | 'UNPAID';
  terms: string;
  notes: string;
  Partner?: PartnerModel;
  PurchaseInvoiceItem?: PurchaseInvoiceItemModel[];
  PurchaseOrder?: SalesOrderModel;
}
