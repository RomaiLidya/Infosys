interface CurrentUser {
  id: number;
  displayName: string;
  email: string;
  firstName: string;
  lastName: string;
  contactNumber: string;
  permission: any;
  SalesRoute?: SalesRoute[];
  pin?: string;
}
