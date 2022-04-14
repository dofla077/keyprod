export default {
  props: {
    title: {
      type: String,
      default: 'Index'
    },
    order: {
      type: Object,
      default: null
    },
    orderProducts: {
      type: Array,
      default: null
    },
    products: {
      type: Array,
      default: null
    },
    headers: {
      type: Array,
      default: null
    },
    submitAction: {
      type: String,
      default: null
    },
    shipmentAction: {
      type: String,
      default: null
    },
    redirectionUrl: {
      type: String,
      default: null
    }
  },
  data: () => ({
    dialog: false,
    dialogDelete: false,

    selected: [],
    shipment: [],
    orderProductsItems: [],
    editedIndex: -1,
    addItem: {
      order_id: null,
      product: '',
      state: '',
      weight: 0
    },
    editedItem: {
      order_id: null,
      product: '',
      state: '',
      weight: 0
    },
    defaultItem: {
      order_id: null,
      product: '',
      state: '',
      weight: 0
    },
  }),
  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Products' : 'Edit Item'
    },

    enrichedOrderProductsItem() {
      return this.orderProductsItems.map(x => ({ ...x, isSelectable: x.state === 'prepared' && !x.shipment }))
    }
  },
  mounted() {
    this.orderProductsItems = this.orderProducts ? this.orderProducts : []
  },
  methods: {
    getColor (state) {
      if (state === 'prepared') return 'green'
      else if (state === 'to prepare') return 'red'
    },
    editItem (item) {
      this.editedIndex = this.orderProductsItems.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      this.editedIndex = this.orderProductsItems.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    deleteItemConfirm () {
      this.orderProductsItems.splice(this.editedIndex, 1)
      this.closeDelete()
    },

    close () {
      this.dialog = false
      this.$nextTick(() => {
        this.addItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    closeDelete () {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.addItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    save () {
      if (this.editedIndex > -1) {
        Object.assign(this.orderProductsItems[this.editedIndex], this.editedItem)
      } else {
        this.setProduct()
        this.addItem = Object.assign({}, this.defaultItem)
      }
      this.close()
    },

    setProduct() {
      let routeaction = this.submitAction
      if (!this.addItem.order_id) {
        this.addItem.order_id = this.order.id
      }
      this.$axios.post(route(routeaction), this.addItem)
        .then(response => {
          if (response.data) {
            let product = response.data
            this.orderProductsItems.push(product)
          }
        })
        .catch(error => {
          this.errorMessages = error.response.data.errors
          this.alertMessage = true
        })
    },
    setShipment() {
      let routeaction = this.shipmentAction
      let redirectionUrl = this.redirectionUrl
      let data = {order_id: this.order.id, products: this.shipment}

      this.$axios.post(route(routeaction), data)
        .then(response => {
          console.log(response.data)
          if (response.data) {
            let shipment = response.data
            window.location = route(redirectionUrl, shipment.id)
          }
        })
        .catch(error => {
          this.errorMessages = error.response.data.errors
          this.alertMessage = true
        })
    }
  },
}
