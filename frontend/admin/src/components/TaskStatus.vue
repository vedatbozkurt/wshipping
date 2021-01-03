<template>
  <span class="badge " :class="statusClass" >
    {{ statusName }}
  </span>
</template>

<script>
  export default {
    props: [ 'status' ],
    data() {
      return {
        statusClass: null,
        statusName: null,
      }
    },
    created() {
      if (this.status == 0 ) {
        this.statusClass= "onaybekliyor";
        this.statusName= "Onay Bekliyor";
      } else if (this.status == 1 ) {
        this.statusClass= "kuryeatamasiyapildi";
        this.statusName= "Kurye Ataması Bekleniyor";
      } else if (this.status == 2 ) {
        this.statusClass= "kuryekabuledilmebekleniyor";
        this.statusName= "Kuryenin Kabul Etmesi Bekleniyor";
      } else if (this.status == 3 ) {
        this.statusClass= "kuryekabuletti";
        this.statusName= "Kurye Kabul etti";
      } else if (this.status == 4 ) {
        this.statusClass= "kuryeyolda";
        this.statusName= "Kurye Yolda";
      } else if (this.status == 5 ) {
        this.statusClass= "kuryehedefevardi";
        this.statusName= "Kurye Hedefe Vardı";
      } else if (this.status == 6 ) {
        this.statusClass= "teslimedildi";
        this.statusName= "Teslim Edildi";
      } else if (this.status == 7 ) {
        this.statusClass= "kuryeiptaletti";
        this.statusName= "İptal Edildi";
      } else {
        this.statusClass= "badge-danger";
        this.statusName= "Not Found";
      }

    },
  }
  //status
            //0:onay bekliyor
            //1:onaylandı-Kurye Ataması Bekleniyor
            //2:Kurye atandı-Kurye Kabul Etmesi Bekleniyor
            //3:Kurye Kabul etti
            //4:Kurye yola çıktı
            //5:Kurye hedefe vardı
            //6:Gönderi teslim edildi
            //7:İptal edildi-Kurye vazgeçti,yeni Kurye Kabul Etmesi Bekleniyor
          </script>
<style scoped>
.onaybekliyor { background-color:#fcd314; }
.kuryeatamasiyapildi { background-color:#99eaff; }
.kuryekabuledilmebekleniyor { background-color:#c6e2ff; }
.kuryekabuletti { background-color:#97e010 ; }
.kuryeyolda { background-color:#7fffbf ; }
.kuryehedefevardi { background-color:#dacdf7 ; }
.teslimedildi { background-color:#10e060 ; }
.kuryeiptaletti { background-color:#e0102f ; }
</style>
