interface StockOutModel {
  id: number;
  PartnerId:number,
  outDate: Date;
  salesNumber: string;
  totalPrice: number;
  totalItem: number;
  description: string;
  WareHouse?: WareHouse;
  StockItem?: StockItem[];
  Partner?:PartnerModel;
}
