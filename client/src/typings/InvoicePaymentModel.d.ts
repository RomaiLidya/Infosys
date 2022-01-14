interface InvoicePaymentModel {
  id: number;
  paymentNumber: string;
  InvoiceId: number;
  payDate: Date;
  totalPay: number | null;
  paymentMethod: string | null;
  note: string;
  BankId: number | null;
  Invoice?: InvoiceModel;
  Bank?: BankModel;
}
