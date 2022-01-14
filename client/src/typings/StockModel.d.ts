interface StockModel {
  id: number;
  PartnerId:number,
  enterDate: Date;
  purchasesNumber: string;
  totalPrice: number;
  totalItem: number;
  description: string;
  searchDate?: string;
  WareHouse?: WareHouse;
  StockItem?: StockItem[];
  Partner?:PartnerModel;
}
