export const dummyProduct: ProductModel = {
  id: 0,
  productName: '',
  productCode: '',
  sellingPrice: 0,
  purchasePrice: 0,
  typeUnit: '',
  totalStock: 0,
  description: '',
  isReminder: false,
  minimumStock: 0,
  image: '' 
};

export const dummyCategory: CategoryModel = {
  id: 0,
  name: '',
  code: '',
  description: ''
};

export const dummyCurrentUser: CurrentUser = {
  id: 0,
  displayName: 'A',
  email: '',
  firstName: '',
  lastName: '',
  contactNumber: '',
  permission: [],
};

export const dummyProductImage: ProductImageModel = {
  id: 0,
  path: '',
  url: ''
};

export const dummySalesOrder: SalesOrderModel = {
  id: 0,
  orderNumber: '',
  PartnerId: 0,
  SalesId: 0,
  dueDate: new Date(),
  orderDate: new Date(),
  totalItem: 0,
  totalPrice: 0,
  totalDiscount: 0,
  statusOrder: 'PENDING',
  terms: '',
  notes: ''
};

export const dummyInvoice: InvoiceModel = {
  id: 0,
  invoiceNumber: '',
  PartnerId: 0,
  SalesId: 0,
  dueDate: new Date(),
  orderDate: new Date(),
  totalItem: 0,
  totalPrice: 0,
  totalDiscount: 0,
  terms: '',
  notes: '',
  totalPay: 0,
  statusPayment: 'UNPAID',
  rounding: 0
};

export const dummyPurchaseOrder: PurchaseOrderModel = {
  id: 0,
  orderNumber: '',
  PartnerId: 0,
  dueDate: new Date(),
  orderDate: new Date(),
  totalItem: 0,
  totalPrice: 0,
  totalDiscount: 0,
  statusOrder: 'PENDING',
  terms: '',
  notes: ''
};

export const dummyPurchaseItem: PurchaseOrderItemModel = {
  id: 0,
  PurchaseOrderId: 0,
  ProductId: 0,
  typeUnit: '',
  totalItem: 0,
  price: 0,
  subTotalPrice: 0,
  totalPrice: 0,
  discount: 0,
  status: 'PENDING'
};

export const dummyUser: UserDetailsModel = {
  id: 0,
  firstName: '',
  lastName: '',
  email: '',
  contactNumber: '',
  name: '',
  role: '',
  roleId: 0
};

export const dummyPartner: PartnerModel = {
  id: 0,
  partnerId: '',
  name: '',
  address: '',
  areaCode: '',
  businessEntity: '',
  cellPhoneNumber: '',
  email: '',
  notes: '',
  phoneNumber: '',
  postalCode: 0,
  regionName: '',
  virtualAccount: '',
  website: '',
  partnerType: 'CUSTOMER',
  dueDate: 0
};

export const dummyZone: ZoneModel = {
  id: 0,
  name: '',
  description: ''
};

export const dummyItem: SalesOrderItemModel = {
  id: 0,
  SalesOrderId: 0,
  ProductId: 0,
  typeUnit: '',
  totalItem: 0,
  price: 0,
  subTotalPrice: 0,
  totalPrice: 0,
  discount: 0,
  status: 'PENDING'
};

export const dummyItemInvoice: InvoiceItemModel = {
  id: 0,
  InvoiceId: 0,
  ProductId: 0,
  typeUnit: '',
  totalItem: 0,
  price: 0,
  subTotalPrice: 0,
  totalPrice: 0,
  discount: 0
};

export const dummyCompany: CompanyModel = {
  id: 0,
  name: '',
  address: '',
  areaCode: '',
  npwpNumber: '',
  cellPhoneNumber: '',
  email: '',
  contactPerson: '',
  phoneNumber: '',
  postalCode: 0,
  website: '',
  image: '' 
};
export const dummyProductSales: ProductSalesModel = {
  id: 0,
  outDate: new Date(),
  salesNumber: '',
  totalPrice: 0,
  description: ''
};
export const dummyWareHouse: WareHouseModel = {
  id: 0,
  name: '',
  address: '',
  description: ''
};

export const dummyStock: StockModel = {
  id: 0,
  enterDate: new Date(),
  purchasesNumber: '',
  totalPrice: 0,
  totalItem: 0,
  description: '',
  PartnerId: 0
};

export const dummyRegion: RegionModel = {
  code: '',
  name: ''
};

export const dummyProductItem: ProductItemModel = {
  id: 0,
  ProductId: 0,
  minimumItem: 0,
  promoPrice: 0,
  bonusItem: 0
};

export const dummyProductPrice: ProductPriceModel = {
  id: 0,
  price: 0,
  ProductId: 0,
  ZoneId: 0
};

export const dummyStockItem = {
  id: 0,
  typeUnit: '',
  purchasePrice: 0,
  totalPrice: 0,
  totalItem: 0,
  logisticPrice: 0,
  unitNetPrice: 0,
  ProductId: 0
};

export const dummyPartnerMinim = {
  id: 0,
  name: ''
};

export const dummyInvoicePayment: InvoicePaymentModel = {
  id: 0,
  paymentNumber: '',
  InvoiceId: 0,
  payDate: new Date(),
  totalPay: null,
  paymentMethod: null,
  note: '',
  BankId: null
};

export const dummyCommissiom: CommissionModel = {
  id: 0,
  month: '',
  monthNumber: 0,
  year: 0,
  SalesId: 0,
  totalInvoice: 0,
  totalBill: 0,
  totalCommission: 0,
  statusCommission: ''
};

export const dummyPackage: ProductPackageModel = {
  id: 0,
  name: '',
  totalPrice: 0,
  description: ''
};

export const dummyReturnOrder: ReturnOrderModel = {
  id: 0,
  orderNumber: '',
  PartnerId: 0,
  SalesId: 0,
  dueDate: new Date(),
  orderDate: new Date(),
  totalItem: 0,
  totalPrice: 0,
  totalDiscount: 0,
  statusOrder: 'PENDING',
  terms: '',
  notes: ''
};

export const dummyStockOut: StockOutModel = {
  id: 0,
  outDate: new Date(),
  salesNumber: '',
  totalPrice: 0,
  totalItem: 0,
  description: '',
  PartnerId: 0
};

export const dummyAccess: AccessModel = {
  id: 0,
  accessId: '',
  level: '',
  access: ''
};

export const dummyPurchaseInvoice: PurchaseInvoiceModel = {
  id: 0,
  invoiceNumber: '',
  invoiceNumberSupplier: '',
  PartnerId: 0,
  dueDate: new Date(),
  orderDate: new Date(),
  totalItem: 0,
  totalPrice: 0,
  totalDiscount: 0,
  terms: '',
  notes: '',
  totalPay: 0,
  statusPayment: 'UNPAID'
};

export const dummyPurchaseInvoiceItem: PurchaseInvoiceItemModel = {
  id: 0,
  PurchaseInvoiceId: 0,
  ProductId: 0,
  typeUnit: '',
  totalItem: 0,
  price: 0,
  subTotalPrice: 0,
  totalPrice: 0,
  discount: 0
};

export const dummyStokAllItem: StockAllItemModel = {
  id: 0,
  typeUnit: '-',
  productName: '-',
  productCode: '-',
  categoryName: '-',
  warehouseName: '-',
  totalStock: 0,
  totalOut: 0
};

export const dummyInvoiceReturn: InvoiceReturnModel = {
  id: 0,
  returnDate: new Date(),
  returnNumber: '',
  InvoiceId: 0,
  SalesId: 0,
  totalItem: 0,
  totalPrice: 0,
  totalDiscount: 0,
  notes: '',
  typeReturn: 'CUSTOMER'
};

export const dummyCart: CartModel = {
  UserId: 0,
  ZoneId: 0
};

export const dummyCartList: CartListModel = {
  id: 0,
  SalesOrderId: 0,
  ProductId: 0,
  typeUnit: '',
  totalItem: 0,
  price: 0,
  subTotalPrice: 0,
  totalPrice: 0,
  discount: 0,
  status: 'PENDING'
};

export const dummyInvoicePiece: InvoicePieceModel = {
  id: 0,
  price: 0,
  type: 'OTHER',
  note: '',
  InvoiceId: 0,
  InvoiceReturnId: 0,
  returnNumber: ''
};

export const dummyBank: BankModel = {
  id: 0,
  bankName: '',
  bankNumber: '',
  bankAccount: '',
  bankCode: ''
};
