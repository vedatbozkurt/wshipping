<script>
  import { Line } from 'vue-chartjs'

  export default {
   extends: Line,
   props: ['user', 'courier'],
   mounted () {
        // this.renderChart(this.user, this.courier)
        this.renderChart({
          labels: [this.$t('month.january'), this.$t('month.february'), this.$t('month.march'), this.$t('month.april'), this.$t('month.may'), this.$t('month.june'), this.$t('month.july'), this.$t('month.august'), this.$t('month.september'), this.$t('month.october'), this.$t('month.november'), this.$t('month.december')],
          datasets: [
          {
            label: 'Couriers',
            backgroundColor: '#DC3545',
            data: this.courier
          },
          {
            label: 'Users',
            backgroundColor: '#28A745',
            data: this.user
          }
          ]
        }, {responsive: true, maintainAspectRatio: false})
      }
    }
  </script>
