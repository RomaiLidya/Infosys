interface StockItemModel {
    id: number;
    typeUnit: string;
    purchasePrice: number;
    totalPrice: number;
    totalItem: number;
    logisticPrice: number;
    unitNetPrice: number;
    ProductId: number;
    Product?: Product;
    Stock?: StockModel;
}