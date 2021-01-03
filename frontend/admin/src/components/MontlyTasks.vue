<script>
    import { Bar } from 'vue-chartjs'

    export default {
      extends: Bar,
      props: ['data'],
      mounted () {
    // Overwriting base render method with actual data.
    this.renderChart({
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
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
