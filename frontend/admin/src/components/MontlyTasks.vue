<script>
  import { Bar } from 'vue-chartjs'

  export default {
    extends: Bar,
    props: ['data'],
    mounted () {
    // Overwriting base render method with actual data.
    this.renderChart({
      labels: [this.$t('month.january'), this.$t('month.february'), this.$t('month.march'), this.$t('month.april'), this.$t('month.may'), this.$t('month.june'), this.$t('month.july'), this.$t('month.august'), this.$t('month.september'), this.$t('month.october'), this.$t('month.november'), this.$t('month.december')],
      datasets: [
      {
        label: 'Created Tasks',
        backgroundColor: '#93E993',
        data: this.data
      }
      ]
    }, {responsive: true, maintainAspectRatio: false})
  }
}
</script>
