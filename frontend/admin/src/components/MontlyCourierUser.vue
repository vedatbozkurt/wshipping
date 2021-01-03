<script>
  import { Line } from 'vue-chartjs'

  export default {
   extends: Line,
   props: ['user', 'courier'],
   watch: {
    courier:{
      deep: true,
      handler(){
        this.renderChart({
          labels: [this.$t('month.january'), this.$t('month.february'), this.$t('month.march'), this.$t('month.april'), this.$t('month.may'), this.$t('month.june'), this.$t('month.july'), this.$t('month.august'), this.$t('month.september'), this.$t('month.october'), this.$t('month.november'), this.$t('month.december')],
          datasets: [
          {
            label: this.$t('courier.courier'),
            backgroundColor: '#DC3545',
            data: this.courier
          },
          {
            label: this.$t('users'),
            backgroundColor: '#28A745',
            data: this.user
          }
          ]
        })
      }
    }
  },
}
</script>
