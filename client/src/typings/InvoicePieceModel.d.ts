interface InvoicePieceModel {
  id: number;
  InvoiceId: number;
  InvoiceReturnId: number;
  returnNumber: string;
  type: 'SHIPPING' | 'ROUNDING' | 'RETURN' | 'OTHER';
  price: number;
  note: string;
  InvoiceReturn?: InvoiceReturnModel;
}
