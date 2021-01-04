/*
* @Author: @vedatbozkurt
* @Date:   2020-04-10 16:28:03
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-17 02:46:45
*/
import Vue from 'vue'
import VueI18n from 'vue-i18n'
//
Vue.use(VueI18n)

// Ready translated locale messages
const messages = {
  en: {
    hello: 'hello',
    home: 'Home',
    company: 'Company',
    notFound: 'Not Found',
    notFoundText: 'Woops! Looks like the page you requested cannot be found.',
    createAddress: 'Create Address',
    editAddress: 'Edit Address',
    addresses: 'Addresses',
    newAddressForm: 'New Address Form',
    editAddressForm: 'Edit Address Form',
    allAddress: 'All Address',
    addressOwner: 'Address Owner',
    addressName: 'Address Name',
    searchAddress: 'Search Address',
    addressList: 'Address List',
    areYouSure: 'Are you sure?',
    noRevert: 'You won\'t be able to revert this!',
    yesDelete: 'Yes, delete it!',
    addressCreated: 'Address has been created.',
    addressUpdated: 'Address has been updated.',
    addressDeleted: 'Address has been deleted.',
    new: 'New',
    login: 'Login',
    logout: 'Logout',
    register: 'Register',
    password: 'Password',
    signin: 'Sign In',
    signinSuccess: 'Success Login.',
    signinStart: 'Sign in to start your session',
    notDefault: 'Not Default',
    default: 'Default',
    dashboard: 'Dashboard',
    save: 'Save',
    cancel: 'Cancel',
    delete: 'Delete',
    actions: 'Actions',
    settings: 'Settings',
    currency: 'Currency',
    profile: 'Profile',
    editProfile: 'Edit Profile',
    updatedProfile: 'Profile has been updated.',
    editSettings: 'Edit Settings',
    confirmPassword: 'Confirm password',
    companyName: 'Company Name',
    settingUpdated: 'Setting has been updated.',
    branches: 'Branches',
    users: 'Users',
    tasks: 'Tasks',
    montlyTasks: 'Montly Tasks',
    restore: 'Restore',
    accept: 'Accept',
    cancelTask: 'Are you sure you want to cancel the task?',
    yesCancel: 'Yes Cancel',
    details: 'Details',
    customization: 'CUSTOMIZATION',
    branch: {
      branch: 'Branch',
      branchCityCouriers: 'Branch City Couriers',
      branchDistrictCouriers: 'Branch District Couriers',
      branchCityTasks: 'Branch City Tasks',
      branchDistrictTasks: 'Branch District Tasks',
      branchCityUsers: 'Branch City Users',
      branchDistrictUsers: 'Branch District Users',
      branchCouriers: 'Branch Couriers',
      branchTasks: 'Branch Tasks',
      branchUsers: 'Branch Users',
      editBranch: 'Edit Branch',
      createBranch: 'Create Branch',
      branches: 'Branches',
      branchesList: 'Branches List',
      branchDetails: 'Branch Details',
      searchBranch: 'Search Branch',
      newBranchForm: 'New Branch Form',
      editBranchForm: 'Edit Branch Form',
      updatedBranch: 'Branch has been updated.',
      deletedBranch: 'Branch has been deleted.',
      createdBranch: 'Branch has been created.',
    },
    courier: {
      courierCityBranches: 'Courier City Branches',
      courierDistrictBranches: 'Courier District Branches',
      couriers: 'Couriers',
      courier: 'Courier',
      couriersDetails: 'Courier Details',
      editCourier: 'Edit Courier',
      createCourier: 'Create Courier',
      searchCourier: 'Search Courier',
      newCourierForm: 'New Courier Form',
      editCourierForm: 'Edit Courier Form',
      couriersList: 'Couriers List',
      updatedCourier: 'Courier has been updated.',
      deletedCourier: 'Courier has been deleted.',
      restoredCourier: 'Courier has been restored.',
      createdCourier: 'Courier has been created.',
      registerCourier: 'Registered successfully',
    },
    form: {
     enterName: 'Enter Name',
     enterEmail: 'Enter Email',
     enterPassword: 'Enter Password',
     logo: 'Logo',
     photo: 'Photo',
     phone: 'Phone',
     description: 'Description',
     address: 'Address',
     keywords: 'Keywords',
     password: 'Password',
     name: 'Name',
     email: 'Email',
     user: 'User',
     city: 'City',
     district: 'District',
     status: 'Status',
     active: 'Active',
     inactive: 'Inactive',
     price: 'Price',
     createdAt: 'Created At',
     deleted: 'Deleted',
     senderName: 'Sender Name',
     senderAddress: 'Sender Address',
     senderPhone: 'Sender Phone',
     receiverName: 'Receiver Name',
     receiverPhone: 'Receiver Phone',
     receiverAddress: 'Receiver Address',
     courierName: 'Courier Name',
     courierPhone: 'Courier Phone',
     noCourier: 'No Courier',
     vehicle: 'Vehicle',
     plate: 'Plate',
     color: 'Color',
     accept: 'Accept'
   },
   select: {
     selectCity: 'Select City',
     selected: 'Selected',
     selectDistrict: 'Select District',
     cantRemove: 'Can\'t remove this value',
   },
   user: {
     userAddresses: 'User Addresses',
     editUser: 'Edit User',
     searchUser: 'Search User',
     userList: 'Users List',
     updatedUser: 'User has been updated.',
     restoredUser: 'User has been restored.',
     deletedUser: 'User has been deleted.',
     createdUser: 'User has been created.',
     receivedTasksByUser: 'Received Tasks by User',
     sentTasksByUser: 'Sent Tasks by User',
     createUser: 'Create User',
     newUserForm: 'New User Form',
     editUserForm: 'Edit User Form',
     userDetails: 'User Details',
     sentDetails: 'Sent Tasks',
     receivedTasks: 'Received Tasks',
   },
   city: {
     cities: 'Cities',
     cityBranches: 'City Branches',
     cityCouriers: 'City Couriers',
     cityDistricts: 'City Districts',
     cityTasks: 'City Tasks',
     cityUsers: 'City Users',
     cityDetails: 'City Details',
     createCity: 'Create City',
     editCity: 'Edit City',
     newCityForm: 'New City Form',
     editCityForm: 'Edit City Form',
     updatedCity: 'City has been updated.',
     deletedCity: 'City has been deleted.',
     createdCity: 'City has been created.',
     searchCity: 'Search City',
     cityList: 'City List',
   },
   district: {
     districts: 'Districts',
     districtBranches: 'District Branches',
     districtCouriers: 'District Couriers',
     districtTasks: 'District Tasks',
     districtUsers: 'District Users',
     editDistrict: 'Edit District',
     createDistrict: 'Create District',
     updatedDistrict: 'District has been updated.',
     deletedDistrict: 'District has been deleted.',
     createdDistrict: 'District has been created.',
     newDistrictForm: 'New District Form',
     editDistrictForm: 'Edit District Form',
     districtDetails: 'District Details',
     searchDistrict: 'Search District',
     districtList: 'District List',
   },
   task: {
     canceled: 'Canceled',
     tasks: 'Tasks',
     myTasks: 'My Taks',
     acceptedTask: 'Success, check my tasks page.',
     canceledTask: 'Duty canceled',
     courierAcceptWarning: 'You will be appointed as a courier of this task!',
     taskList: 'Task List',
     taskSearch: 'Search Task',
     createTask: 'Create Task',
     createdTaskNumber: 'Created Task',
     editTask: 'Edit Task',
     editTaskForm: 'Edit Task Form',
     newTaskForm: 'New Task Form',
     pendingApproval: 'Pending Approval',
     approvedAwaitingCourierAssignment: 'Approved - Awaiting Courier Assignment',
     courierAssignedAcceptanceExpected: 'Courier Assigned - Acceptance expected',
     courierAccepted: 'Courier Accepted',
     courierOnTheRoad: 'Courier On The Road',
     courierArrivedAtDestination: 'Courier Arrived at Destination',
     delivered: 'Delivered',
     couriercanceled: 'courier canceled - new courier expected',
     restoredTask: 'Task has been restored.',
     updatedTask: 'Task has been updated.',
     createdTask: 'Task has been created.',
     deletedTask: 'Task has been deleted.',
     courierReceivedTask: 'Courier Received Task.',
     accepttask: 'Accept The Task',
     receivedtask: 'I Received The Task',
     onroad: 'I set out',
     arrived: 'Arrived at Destination Address',
     deliveredtask: 'I Delivered The Task',
   },
   month: {
     january: 'January',
     february: 'February',
     march: 'March',
     april: 'April',
     may: 'May',
     june: 'June',
     july: 'July',
     august: 'August',
     september: 'September',
     october: 'October',
     november: 'November',
     december: 'December',
   }

 },
 tr: {
  home: 'Anasayfa',
  company: 'Firma',
  notFound: 'Bulunamadı',
  notFoundText: 'Woops!  İstediğiniz sayfa bulunamadı gibi görünüyor.',
  createAddress: 'Adres Oluştur',
  editAddress: 'Adresi Düzenle',
  addresses: 'Adresler',
  newAddressForm: 'Yeni Adres Formu',
  editAddressForm: 'Adres Düzenleme Formu ',
  allAddress: 'Adresin Devamı',
  addressOwner: 'Adres Sahibi',
  addressName: 'Adres Adı',
  searchAddress: 'Adres Ara',
  addressList: 'Adres Listesi',
  areYouSure: 'Emin misin?',
  noRevert: 'Bu işlemi geri alamayacaksın!',
  yesDelete: 'Evet, sil!',
  addressCreated: 'Adres oluşturuldu.',
  addressUpdated: 'Adres güncellendi.',
  addressDeleted: 'Adres silindi.',
  new: 'Yeni',
  login: 'Giriş ',
  logout: 'Çıkış',
  register: 'Kayıt',
  password: 'Şifre',
  signin: 'Oturum Aç',
  signinSuccess: 'Başarılı Giriş.',
  signinStart: 'Oturumunuzu başlatmak için giriş yapın.',
  notDefault: 'Varsayılan Değil',
  default: 'Varsayılan',
  dashboard: 'Kontrol Paneli',
  save: 'Kaydet',
  cancel: 'İptal',
  delete: 'Sil',
  actions: 'Eylemler',
  settings: 'Ayarlar',
  currency: 'Para Birimi',
  profile: 'Profil',
  editProfile: 'Profili Düzenle',
  updatedProfile: 'Profil güncellendi.',
  editSettings: 'Ayarları Düzenle',
  confirmPassword: 'Parolayı onaylayın',
  companyName: 'Firma Adı',
  settingUpdated: 'Ayarlar güncellendi.',
  branches: 'Şubeler',
  users: 'Kullanıcılar',
  tasks: 'Gönderiler',
  montlyTasks: 'Aylık Gönderiler',
  restore: 'Geri Yükle',
  details: 'Ayrıntılar',
  accept: 'Kabul Et',
  cancelTask: 'Görevi iptal etmek istediğine emin misin?',
  yesCancel: 'Evet İptal Et',
  customization: 'ÖZELLEŞTİRME',
  branch: {
    branch: 'Şube',
    branchCityCouriers: 'Şube İli Kuryeleri',
    branchDistrictCouriers: 'Şube İlçesi Kuryeleri',
    branchCityTasks: 'Şube İli Gönderileri',
    branchDistrictTasks: 'Şube İlçesi Gönderileri',
    branchCityUsers: 'Şube İli Kullanıcıları',
    branchDistrictUsers: 'Şube İlçesi Kullanıcıları',
    branchCouriers: 'Şube Kuryeleri',
    branchTasks: 'Şube Gönderileri',
    branchUsers: 'Şube Kullanıcıları',
    editBranch: 'Şubeyi Düzenle',
    createBranch: 'Şube Oluştur',
    branches: 'Şubeler',
    branchesList: 'Şube Listesi',
    branchDetails: 'Şube Ayrıntıları',
    searchBranch: 'Şube Ara',
    newBranchForm: 'Yeni Şube Formu',
    editBranchForm: 'Şube Düzenleme Formu ',
    updatedBranch: 'Şube güncellendi.',
    deletedBranch: 'Şube silindi.',
    createdBranch: 'Şube oluşturuldu.',
  },
  courier: {
    courierCityBranches: 'Kurye İllerinin Şubeleri',
    courierDistrictBranches: 'Kurye İlçelerinin Şubeleri',
    couriers: 'Kuryeler',
    courier: 'Kurye',
    couriersDetails: 'Kurye Ayrıntıları',
    editCourier: 'Kurye Düzenle',
    createCourier: 'Kurye Oluştur',
    searchCourier: 'Kurye Ara',
    newCourierForm: 'Yeni Kurye Formu',
    editCourierForm: 'Kurye Düzenleme Formu ',
    couriersList: 'Kurye Listesi',
    updatedCourier: 'Kurye güncellendi.',
    deletedCourier: 'Kurye silindi.',
    restoredCourier: 'Kurye geri yüklendi.',
    createdCourier: 'Kurye oluşturuldu.',
    registerCourier: 'Kayıt başarılı.',
  },
  form: {
   enterName: 'Ad Gir',
   enterEmail: 'E-posta Gir',
   enterPassword: 'Parola Gir',
   logo: 'Logo',
   photo: 'Fotoğraf',
   phone: 'Telefon',
   description: 'Açıklama',
   address: 'Adres',
   keywords: 'Anahtar kelimeler',
   password: 'Şifre',
   name: 'Ad',
   email: 'E-posta',
   user: 'Kullanıcı',
   city: 'İl',
   district: 'İlçe',
   status: 'Durum',
   active: 'Aktif',
   inactive: 'Pasif',
   price: 'Fiyat',
   createdAt: 'Oluşturulma',
   deleted: 'Silindi',
   senderName: 'Gönderen Adı',
   senderAddress: 'Gönderen Adresi',
   senderPhone: 'Gönderen Telefonu',
   receiverName: 'Alıcı Adı',
   receiverPhone: 'Alıcı Telefonu',
   receiverAddress: 'Alıcı Adresi',
   courierName: 'Kurye Adı',
   courierPhone: 'Kurye Telefonu',
   noCourier: 'Kurye Yok',
   vehicle: 'Araç',
   plate: 'Plaka',
   color: 'Renk',
   accept: 'Kabul Et'
 },
 select: {
   selectCity: 'İl Seç',
   selected: 'Seçildi',
   selectDistrict: ' İlçe Seç',
   cantRemove: 'Bu değer kaldırılamıyor',
 },
 user: {
   userAddresses: 'Kullanıcı Adresleri',
   editUser: 'Kullanıcıyı Düzenle',
   searchUser: 'Kullanıcı Ara',
   userList: 'Kullanıcı Listesi',
   updatedUser: 'Kullanıcı güncellendi.',
   restoredUser: 'Kullanıcı geri yüklendi.',
   deletedUser: 'Kullanıcı silindi.',
   createdUser: 'Kullanıcı oluşturuldu.',
   receivedTasksByUser: 'Kullanıcı Tarafından Alınan Gönderiler',
   sentTasksByUser: 'Kullanıcı Tarafından Gönderilen Gönderiler',
   createUser: 'Kullanıcı Oluştur',
   newUserForm: 'Yeni Kullanıcı Formu',
   editUserForm: 'Kullanıcı Düzenle Formu ',
   userDetails: 'Kullanıcı Ayrıntıları',
   sentDetails: 'Gönderilen Gönderiler',
   receivedTasks: 'Alınan Gönderiler',
 },
 city: {
   cities: 'İller',
   cityBranches: ' Şubeleri',
   cityCouriers: 'İl Kuryeleri',
   cityDistricts: 'İl İlçeleri',
   cityTasks: 'İl Gönderileri',
   cityUsers: 'İl Kullanıcıları',
   cityDetails: 'İl Ayrıntıları',
   createCity: 'İl Oluştur',
   editCity: 'İl Düzenle',
   newCityForm: 'Yeni İl Formu',
   editCityForm: 'İl Düzenleme Formu ',
   updatedCity: 'İl Güncellendi.',
   deletedCity: 'İl Silindi.',
   createdCity: 'İl Oluşturuldu.',
   searchCity: 'İl Ara',
   cityList: 'İl Listesi',
 },
 district: {
   districts: 'İlçeler',
   districtBranches: 'İlçe Şubeleri',
   districtCouriers: 'İlçe Kuryeleri',
   districtTasks: 'İlçe Gönderileri',
   districtUsers: 'İlçe Kullanıcıları',
   editDistrict: 'İlçe Düzenle',
   createDistrict: 'İlçe Oluştur',
   updatedDistrict: 'İlçe güncellendi.',
   deletedDistrict: 'İlçe Silindi.',
   createdDistrict: 'İlçe Oluşturuldu',
   newDistrictForm: 'Yeni İlçe Formu',
   editDistrictForm: 'İlçe Düzenleme Formu',
   districtDetails: 'İlçe Detayları',
   searchDistrict: 'İlçe Ara',
   districtList: 'İlçe Listesi',
 },
 task: {
   canceled: 'İptal Edildi',
   myTasks: 'Gönderilerim',
   acceptedTask: 'İşlem başarılı, Gönderilerim sayfasını kontrol et.',
   canceledTask: 'Gönderi kurye görevin iptal edildi.',
   courierAcceptWarning: 'Bu gönderinin kuryesi olarak atanacaksın!',
   tasks: 'Gönderiler',
   taskList: 'Gönderi Listesi',
   taskSearch: 'Gönderi Ara',
   createTask: 'Gönderi Oluştur',
   createdTaskNumber: 'Oluşturulan Gönderiler',
   editTask: 'Gönderi Düzenle',
   editTaskForm: 'Gönderi Düzenleme Formu',
   newTaskForm: 'Yeni Gönderi Formu',
   pendingApproval: 'Onay Bekliyor',
   approvedAwaitingCourierAssignment: 'Onaylandı - Kurye Ataması Bekleniyor',
   courierAssignedAcceptanceExpected: 'Kurye Atandı-Kurye Kabul Etmesi Bekleniyor',
   courierAccepted: 'Kurye Kabul etti',
   courierOnTheRoad: 'Kurye Yolda',
   courierArrivedAtDestination: 'Kurye Hedefe Vardı',
   delivered: 'Teslim Edildi',
   couriercanceled: 'Kurye iptal etti-Yeni kurye bekleniyor',
   restoredTask: 'Gönderi onarıldı.',
   updatedTask: 'Gönderi güncellendi.',
   createdTask: 'Gönderi oluşturuldu.',
   deletedTask: 'Gönderi silindi.',
   courierReceivedTask: 'Kurye Gönderiyi Teslim Aldı.',
   accepttask: 'Görevi Kabul Ediyorum',
   receivedtask: 'Gönderiyi Teslim Aldım',
   onroad: 'Teslim Etmek İçin Yola Çıktım',
   arrived: 'Hedef Adrese Vardım',
   deliveredtask: 'Gönderiyi Teslim Ettim',

 },
 month: {
   january: 'Ocak',
   february: 'Şubat',
   march: 'Mart',
   april: 'Nisan',
   may: 'Mayıs',
   june: 'Haziran',
   july: 'Temmuz',
   august: 'Ağustos',
   september: 'Eylül',
   october: 'Ekim',
   november: 'Kasım',
   december: 'Aralık',
 }
},
fr: {
        // message: {
          hello: 'Bonjour',
          company: 'Firma',
        // }
      }
    }
    var locale = localStorage.getItem('userlocale')
    if (!locale) {
      locale = 'tr';
    }
    const i18n = new VueI18n({
locale: locale, // set locale
messages, // set locale messages
})
    export default i18n