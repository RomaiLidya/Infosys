interface SalesModel {
    id: number;
    salesId: string;
    name: string;
    phoneNumber: string;
    email: string;
    address: string;
    invoices?: InvoiceModel[];
  }
  