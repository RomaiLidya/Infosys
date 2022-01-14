interface ReturnOrderModel {
  id: number;
  orderNumber: string;
  PartnerId: number;
  SalesId: number;
  dueDate: Date;
  totalItem: number;
  totalPrice: number;
  totalDiscount: number;
  statusOrder: 'PENDING' | 'CANCEL' | 'CONFIRMATION';
  terms: string;
  orderDate: Date;
  notes: string;
  Partner?: PartnerModel;
  SalesOrderItem?: SalesOrderItem[];
  Sales?: UserDetailsModel;
  signatureUrl?: string;
  signaturePath?: string;
  InvoiceId? : number;
}
