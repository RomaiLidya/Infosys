const BASE_URL = process.env.REACT_APP_API_BASE_URL;

export const LOGIN_URL = `${BASE_URL}/login`;
export const LOGOUT_URL = `${BASE_URL}/logout`;
export const FORGOT_PASSWORD_URL = `${BASE_URL}/forgotpassword`;
export const RESET_PASSWORD_URL = `${BASE_URL}/resetpassword`;
export const CHANGE_PASSWORD_URL = `${BASE_URL}/changepassword`;

export const USER_BASE_URL = `${BASE_URL}/users`;
export const GET_CURRENT_USER_URL = `${USER_BASE_URL}/me`;
export const GET_EDIT_USER_URL = (userId: number) => `${USER_BASE_URL}/${userId}`;
export const GET_SALES_USER_URL = (params: string) => `${USER_BASE_URL}?${params}`;
export const GET_USER_DETAIL_URL = (id: number) => `${USER_BASE_URL}/${id}`;
export const GET_CONFIRMATION_PASSWORD_URL = `${USER_BASE_URL}/confirmation-password`;

export const COMPANY_BASE_URL = `${BASE_URL}/company`;
export const COMPANY_UPLOAD_BASE_URL = `${COMPANY_BASE_URL}/upload`;

export const ACCESS_USER_BASE_URL = `${BASE_URL}/access`;
export const GET_EDIT_ACCESS_USER_URL = (accesUserId: number) => `${ACCESS_USER_BASE_URL}/${accesUserId}`;

export const ROLE_BASE_URL = `${BASE_URL}/roles`;

export const PERMISSION_BASE_URL = `${BASE_URL}/permission`;
export const SET_PERMISSION_BASE_URL = `${BASE_URL}/permission/set-permission`;
export const DELETE_PERMISSION_BASE_URL = `${BASE_URL}/permission/delete-permission`;
export const GET_PERMISSION_BASE_URL = (userId: number) => `${BASE_URL}/permission/get-permission/${userId}`;

export const PARTNER_BASE_URL = `${BASE_URL}/partner`;
export const PARTNER_LAST_ID_BASE_URL = `${PARTNER_BASE_URL}/last`;
export const PARTNER_DETAIL_BASE_URL = (id: number) => `${PARTNER_BASE_URL}/${id}`;

export const WILAYAH_BASE_URL = `${BASE_URL}/wilayah`;
export const WILAYAH_PROVINSI_BASE_URL = `${WILAYAH_BASE_URL}/provinsi`;
export const WILAYAH_KABUPATEN_BASE_URL = (code: string) => `${WILAYAH_BASE_URL}/kabupaten/${code}`;
export const WILAYAH_KECAMATAN_BASE_URL = (code: string) => `${WILAYAH_BASE_URL}/kecamatan/${code}`;

export const ZONE_BASE_URL = `${BASE_URL}/zone`;

export const PRODUCT_BASE_URL = `${BASE_URL}/product`;
export const GET_CODE_BASE_URL = `${PRODUCT_BASE_URL}/get-code`;
export const PRODUCT_UPLOAD_MAGE_BASE_URL = `${PRODUCT_BASE_URL}/upload`;
export const GET_PRODUCT_DETAIL_BASE_URL = (id: number) => `${PRODUCT_BASE_URL}/${id}`;
export const PRODUCT_IMAGE_DELETE_BASE_URL = (id: number) => `${PRODUCT_BASE_URL}/image/${id}`;

export const PACKAGE_BASE_URL = `${BASE_URL}/package`;

export const STOCK_BASE_URL = `${BASE_URL}/stock`;
export const STOCK_ALL_BASE_URL = `${STOCK_BASE_URL}/all`;
export const STOCK_WAREHOUSE_BASE_URL = `${STOCK_BASE_URL}/warehouse`;
export const GET_STOCK_DETAIL_BASE_URL = (id: number) => `${STOCK_BASE_URL}/${id}`;
export const DELETE_STOCK_DETAIL_BASE_URL = (id: number) => `${STOCK_BASE_URL}/${id}`;

export const STOCK_ITEM_BASE_URL = `${BASE_URL}/stock-item`;
export const GET_PRODUCT_WAREHOUSE_BASE_URL = (id: number) => `${STOCK_ITEM_BASE_URL}/product/${id}`;

export const CATEGORY_BASE_URL = `${BASE_URL}/category`;
export const WAREHOUSE_BASE_URL = `${BASE_URL}/warehouse`;
export const SALES_BASE_URL = `${BASE_URL}/sales`;

export const SALES_ORDER_BASE_URL = `${BASE_URL}/sales-order`;
export const SALES_ORDER_UPLOAD_BASE_URL = `${SALES_ORDER_BASE_URL}/upload`;
export const GET_SALES_ORDER_DETAIL_BASE_URL = (id: number) => `${SALES_ORDER_BASE_URL}/${id}`;
export const GET_SALES_ORDER_ITEM_BASE_URL = (id: number) => `${BASE_URL}/order-item/${id}`;
export const GET_SALES_ORDER_NUMBER_BASE_URL = `${SALES_ORDER_BASE_URL}/number`;

export const PURCHASE_ORDER_BASE_URL = `${BASE_URL}/purchase-order`;
export const PURCHASE_ORDER_UPLOAD_BASE_URL = `${PURCHASE_ORDER_BASE_URL}/upload`;
export const GET_PURCHASE_ORDER_DETAIL_BASE_URL = (id: number) => `${PURCHASE_ORDER_BASE_URL}/${id}`;
export const GET_PURCHASE_ORDER_ITEM_BASE_URL = (id: number) => `${PURCHASE_ORDER_BASE_URL}/item/${id}`;
export const GET_PURCHASE_ORDER_NUMBER_BASE_URL = `${PURCHASE_ORDER_BASE_URL}/number`;

export const PURCHASE_INVOICE_BASE_URL = `${BASE_URL}/purchase-invoice`;
export const PURCHASE_INVOICE_UPLOAD_BASE_URL = `${PURCHASE_INVOICE_BASE_URL}/upload`;
export const GET_PURCHASE_INVOICE_DETAIL_BASE_URL = (id: number) => `${PURCHASE_INVOICE_BASE_URL}/${id}`;
export const GET_PURCHASE_INVOICE_ITEM_BASE_URL = (id: number) => `${PURCHASE_INVOICE_BASE_URL}/item/${id}`;

export const INVOICE_BASE_URL = `${BASE_URL}/invoice`;
export const INVOICE_ROUNDING_BASE_URL = `${INVOICE_BASE_URL}/rounding`;
export const GET_INVOICE_DETAIL_BASE_URL = (id: number) => `${INVOICE_BASE_URL}/${id}`;

export const INVOICE_ITEM_URL = `${BASE_URL}/invoice-item`;

export const INVOICE_PAYMENT_BASE_URL = `${BASE_URL}/invoice-payment`;
export const GET_INVOICE_PAYMENT_DETAIL_BASE_URL = (id: number) => `${INVOICE_PAYMENT_BASE_URL}/${id}`;

export const INVOICE_PIECE_BASE_URL = `${BASE_URL}/invoice-piece`;

export const COMMISSION_BASE_URL = `${BASE_URL}/commission`;
export const GET_COMMISSION_DETAIL_BASE_URL = (id: number) => `${COMMISSION_BASE_URL}/${id}`;
export const COMMISSION_EXPORT_BASE_URL = (id: number) => `${COMMISSION_BASE_URL}/export/${id}`;

export const RETURN_ORDER_BASE_URL = `${BASE_URL}/return-order`;
export const GET_RETURN_ORDER_DETAIL_BASE_URL = (id: number) => `${RETURN_ORDER_BASE_URL}/${id}`;

export const RETURN_INVOICE_BASE_URL = `${BASE_URL}/invoice-return`;
export const RETURN_DELETE_INVOICE_BASE_URL = (id: number) => `${RETURN_INVOICE_BASE_URL}/${id}`;
export const GET_RETURN_INVOICE_DETAIL_BASE_URL = (id: number) => `${RETURN_INVOICE_BASE_URL}/${id}`;

export const SALES_ROUTE_BASE_URL = `${BASE_URL}/sales-route`;

export const BANK_BASE_URL = `${BASE_URL}/bank`;
export const GET_DETAIL_BANK_BASE_URL = (id: number) => `${BANK_BASE_URL}/${id}`;
export const DELETE_BANK_BASE_URL = (id: number) => `${BANK_BASE_URL}/${id}`;
