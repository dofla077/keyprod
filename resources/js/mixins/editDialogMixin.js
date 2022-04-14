export default {
  props: {
    submitAction: {
      type: String,
      default: null
    },
  },
  data: () => ({
    snack: false,
    snackColor: '',
    snackText: '',
    max25chars: v => v.length <= 25 || 'Input too long!',
    pagination: {},

  }),
  methods: {
    save (item) {
      this.updateTracking(item)
    },
    cancel () {
      this.snack = true
      this.snackColor = 'error'
      this.snackText = 'Canceled'
    },
    close () {
      console.log('Dialog closed')
    },
    updateTracking(item) {
      let routeaction = this.submitAction

      this.$axios.post(route(routeaction), item)
        .then(response => {
          if (response.data) {
            this.snack = true
            this.snackColor = 'success'
            this.snackText = 'Tracking updated'
          }
        })
        .catch(error => {
          this.snack = true
          this.snackColor = 'error'
          this.snackText = 'Tracking not saved'
        })
    }
  }
}
