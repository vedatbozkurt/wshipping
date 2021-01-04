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
        this.statusName= this.$t('task.pendingApproval');
      } else if (this.status == 1 ) {
        this.statusClass= "kuryeatamasiyapildi";
        this.statusName= this.$t('task.approvedAwaitingCourierAssignment');
      } else if (this.status == 2 ) {
        this.statusClass= "kuryekabuledilmebekleniyor";
        this.statusName= this.$t('task.courierAssignedAcceptanceExpected');
      } else if (this.status == 3 ) {
        this.statusClass= "kuryekabuletti";
        this.statusName= this.$t('task.courierAccepted');
      } else if (this.status == 4 ) {
        this.statusClass= "kuryegonderiyialdi";
        this.statusName= this.$t('task.courierReceivedTask');
      } else if (this.status == 5 ) {
        this.statusClass= "kuryeyolda";
        this.statusName= this.$t('task.courierOnTheRoad');
      } else if (this.status == 6 ) {
        this.statusClass= "kuryehedefevardi";
        this.statusName= this.$t('task.courierArrivedAtDestination');
      } else if (this.status == 7 ) {
        this.statusClass= "teslimedildi";
        this.statusName= this.$t('task.delivered');
      } else if (this.status == 8 ) {
        this.statusClass= "kuryeiptaletti";
        this.statusName= this.$t('task.couriercanceled');
      } else {
        this.statusClass= "badge-danger";
        this.statusName= this.$t('notFound');
      }

    },
  }
 //status
            //0:onay bekliyor
            //1:onaylandı-Kurye Ataması Bekleniyor
            //2:Kurye atandı-Kurye Kabul Etmesi Bekleniyor
            //3:Kurye Kabul etti
            //4:Kurye gönderiyi teslim aldı
            //5:Kurye yola çıktı
            //6:Kurye hedefe vardı
            //7:Gönderi teslim edildi
            //8:Kurye vazgeçti,yeni Kurye Kabul Etmesi Bekleniyor
            //9:İptal edildi
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
.kuryegonderiyialdi { background-color:#b87afa ; }
</style>
