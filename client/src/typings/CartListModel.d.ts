interface CartListModel {
    id: number;
    SalesOrderId: number;
    ProductId: number;
    typeUnit: string;
    totalItem: number;
    price: number;
    subTotalPrice: number;
    totalPrice: number;
    discount: number;
    status: 'CONFIRM' | 'PENDING' | 'REJECT' | 'HAS_INVOICE';
    productName?: string;
    productCode?: string;
    productImage?: string;

}
