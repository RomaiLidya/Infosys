interface CompanyModel {
  id: number;
  name: string;
  phoneNumber: string;
  cellPhoneNumber: string;
  email: string;
  website: string;
  npwpNumber: string;
  contactPerson: string;
  address: string;
  areaCode: string;
  postalCode: number;
  image: string;
  imageUrl?: string;  
  Provinsi?: RegionModel;
  Kabupaten?: RegionModel;
  Kecamatan?: RegionModel;
  Bank?: AccountBankModel;
}
