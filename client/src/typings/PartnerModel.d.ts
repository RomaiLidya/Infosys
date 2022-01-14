interface PartnerModel {
  id: number;
  partnerId: string;
  partnerType?: 'SUPPLIER' | 'CUSTOMER';
  name: string;
  phoneNumber: string;
  cellPhoneNumber: string;
  email: string;
  website: string;
  businessEntity: string;
  virtualAccount: string;
  address: string;
  areaCode: string;
  regionName: string;
  postalCode: number | null;
  notes: string;
  dueDate: number | null;
  plafon?: number | null;
  totalBill?: number;
  isDeleted?: boolean;
  ZoneId?: number;
  Zone?: ZoneModel;
  Provinsi?: RegionModel;
  Kabupaten?: RegionModel;
  Kecamatan?: RegionModel;
  new?: boolean;
  hasDebt?: boolean;
}
