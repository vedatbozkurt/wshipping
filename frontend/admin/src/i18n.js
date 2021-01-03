/*
* @Author: @vedatbozkurt
* @Date:   2020-04-10 16:28:03
* @Last Modified by:   @vedatbozkurt
* @Last Modified time: 2020-07-07 03:35:06
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
        couriers: 'Couriers',
        users: 'Users',
        tasks: 'Tasks',
        montlyTasks: 'Montly Tasks',
        form: {
           enterName: 'Enter Name',
           enterEmail: 'Enter Email',
           enterPassword: 'Enter Password',
           logo: 'Logo',
           phone: 'Phone',
           description: 'Description',
           address: 'Address',
           keywords: 'Keywords',
           name: 'Name',
           email: 'Email',
           user: 'User',
           city: 'City',
           district: 'District',
           status: 'Status',
       },
       select: {
           selectCity: 'Select City',
           selected: 'Selected',
           selectDistrict: 'Select District',
           cantRemove: 'Can\'t remove this value',
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

    hello: 'merhaba',
    company: 'Firma',
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
    locale = 'en';
}
const i18n = new VueI18n({
locale: locale, // set locale
messages, // set locale messages
})
export default i18n
