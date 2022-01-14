interface ProductSalesModel {
    id: number;
    outDate: Date;
    salesNumber: string;
    totalPrice: number;
    description: string;
    WareHouse?: WareHouse;
    StockItem?: StockItem[];
  }
  