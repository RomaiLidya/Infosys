interface InvoiceModel {
  id: number;
  invoiceNumber: string;
  PartnerId: number;
  SalesId: number;
  dueDate: Date;
  orderDate: Date;
  paidDate?: Date;
  totalItem: number;
  totalPrice: number;
  totalDiscount: number;
  rounding: number;
  totalPay: number;
  totalReturn?: number;
  totalInvoice?: number;
  statusPayment: 'PAID' | 'UNPAID';
  terms: string;
  notes: string;
  Partner?: PartnerModel;
  InvoiceItem?: InvoiceItemModel[];
  Sales?: UserDetailsModel;
  SalesOrder?: SalesOrderModel;
  createdAt?: string;
  typeInvoice?: 'GENERAL' | 'ALLOWED';
  paymentDue?: Date;
  isDue?: boolean;
}
