interface PurchaseOrderModel {
  id: number;
  orderNumber: string;
  PartnerId: number;
  dueDate: Date;
  totalItem: number;
  totalPrice: number;
  totalDiscount: number;
  statusOrder: 'PENDING' | 'CANCEL' | 'CONFIRMATION';
  terms: string;
  orderDate: Date;
  notes: string;
  Partner?: PartnerModel;
  PurchaseOrderItem?: PurchaseOrderItem[];
  signatureUrl?: string;
  signaturePath?: string;
  purchaseInvoiceId?: number;
}
