interface UserDetailsModel {
  id: number;
  firstName: string;
  lastName: string;
  email: string;
  contactNumber: string;
  name: string;
  address?: string;
  roleId: number;
  role: string;
  new?: boolean;
  Commission?: CommissionModel[];
  RolePermissions?: PermissionModel[];
  SalesRoute?: SalesRoute[];
}
