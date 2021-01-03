<script>
    import { Line } from 'vue-chartjs'

    export default {
       extends: Line,
       props: ['user', 'courier'],
       mounted () {
        // this.renderChart(this.user, this.courier)
        this.renderChart({
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
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
