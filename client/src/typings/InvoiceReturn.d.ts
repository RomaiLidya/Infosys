interface InvoiceReturnModel {
  id: number;
  returnDate: Date;
  returnNumber: string;
  InvoiceId: number;
  SalesId: number;
  totalItem: number;
  totalPrice: number;
  totalDiscount: number;
  notes: string;
  Partner?: PartnerModel;
  Sales?: SalesModel;
  typeReturn: 'SUPPLIER' | 'CUSTOMER';
  InvoiceReturnItem?: InvoiceReturnItemModel[];
  createdAt?: string;
}
