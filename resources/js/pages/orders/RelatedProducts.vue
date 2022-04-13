<template>
  <v-app>
    <v-data-table
      :headers="headers"
      :items="orderProductsItems"
      sort-by="calories"
      class="elevation-1"
    >
      <template #top>
        <v-toolbar
          flat
        >
          <v-toolbar-title>
            Order : {{ title }}
          </v-toolbar-title>
          <v-divider
            class="mx-4"
            inset
            vertical
          />
          <v-spacer />
          <v-dialog
            v-model="dialog"
            max-width="500px"
          >
            <template #activator="{ on, attrs }">
              <v-btn
                color="primary"
                dark
                class="mb-2"
                v-bind="attrs"
                v-on="on"
              >
                Add products
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="text-h5">
                  {{ formTitle }}
                </span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col
                      cols="12"
                      sm="6"
                    >
                      <v-subheader v-text="'Multiple (Chips) with persistent hint'" />
                    </v-col>

                    <v-col cols="12" lg="8">
                      <v-select
                        v-model="addProducts"
                        :items="products" label="Standard" multiple
                        persistent-hint
                      >
                        <template #selection="{ item, index }">
                          <qr-code text="Text to encode" :size="50" :margin="10">
                            {{ item.label }}
                          </qr-code> {{ item.label }}
                        </template>
                        <template #item="{ item }">
                          <qr-code text="Text to encode" :size="50" :margin="10">
                            {{ item.label }}
                          </qr-code> {{ item.label }}
                        </template>
                      </v-select>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer />
                <v-btn
                  color="blue darken-1"
                  text
                  @click="close"
                >
                  Cancel
                </v-btn>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="save"
                >
                  Save
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5">
                Are you sure you want to delete this item?
              </v-card-title>
              <v-card-actions>
                <v-spacer />
                <v-btn color="blue darken-1" text @click="closeDelete">
                  Cancel
                </v-btn>
                <v-btn color="blue darken-1" text @click="deleteItemConfirm">
                  OK
                </v-btn>
                <v-spacer />
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template #item.actions="{ item }">
        <v-icon
          small
          class="mr-2"
          @click="editItem(item)"
        >
          mdi-pencil
        </v-icon>
        <v-icon
          small
          @click="deleteItem(item)"
        >
          mdi-delete
        </v-icon>
      </template>
    </v-data-table>
  </v-app>
</template>

<script>

export default {
  name: 'RelatedProducts',
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
    }
  },
  data: () => ({
    dialog: false,
    dialogDelete: false,
    items: [
      { name: 'Foo', image: 'https://www.gravatar.com/avatar/b17065ea1655f1e3283aac8d8fc16019?s=48&d=identicon&r=PG'},
      { name: 'Bar', image: 'https://www.gravatar.com/avatar/b17065ea1655f1e3283aac8d8fc16019?s=48&d=identicon&r=PG'},
      { name: 'Hoo', image: 'https://www.gravatar.com/avatar/b17065ea1655f1e3283aac8d8fc16019?s=48&d=identicon&r=PG'},
      { name: 'Coo', image: 'https://www.gravatar.com/avatar/b17065ea1655f1e3283aac8d8fc16019?s=48&d=identicon&r=PG'}],
    /*headers: [
      {
        text: 'Dessert (100g serving)',
        align: 'start',
        sortable: false,
        value: 'name',
      },
      { text: 'Calories', value: 'calories' },
      { text: 'Fat (g)', value: 'fat' },
      { text: 'Carbs (g)', value: 'carbs' },
      { text: 'Protein (g)', value: 'protein' },
      { text: 'Actions', value: 'actions', sortable: false },
    ],*/
    desserts: [],
    orderProductsItems: [],
    editedIndex: -1,
    addProducts: [],
    editedItem: {
      label: '',
      type: '',
      version: '',
      identified: '',
      updated_at: '',
    },
    defaultItem: {
      label: '',
      type: '',
      version: '',
      identified: '',
      updated_at: '',
    },
  }),
  computed: {
    formTitle () {
      return this.editedIndex === -1 ? 'Products' : 'Edit Item'
    },
  },
  mounted() {
    this.orderProductsItems = this.orderProducts ? this.orderProducts : []
  },
  methods: {
    initialize () {
      /*this.desserts = [
        {
          name: 'Frozen Yogurt',
          calories: 159,
          fat: 6.0,
          carbs: 24,
          protein: 4.0,
        },
        {
          name: 'Ice cream sandwich',
          calories: 237,
          fat: 9.0,
          carbs: 37,
          protein: 4.3,
        },
        {
          name: 'Eclair',
          calories: 262,
          fat: 16.0,
          carbs: 23,
          protein: 6.0,
        },
        {
          name: 'Cupcake',
          calories: 305,
          fat: 3.7,
          carbs: 67,
          protein: 4.3,
        },
        {
          name: 'Gingerbread',
          calories: 356,
          fat: 16.0,
          carbs: 49,
          protein: 3.9,
        },
        {
          name: 'Jelly bean',
          calories: 375,
          fat: 0.0,
          carbs: 94,
          protein: 0.0,
        },
        {
          name: 'Lollipop',
          calories: 392,
          fat: 0.2,
          carbs: 98,
          protein: 0,
        },
        {
          name: 'Honeycomb',
          calories: 408,
          fat: 3.2,
          carbs: 87,
          protein: 6.5,
        },
        {
          name: 'Donut',
          calories: 452,
          fat: 25.0,
          carbs: 51,
          protein: 4.9,
        },
        {
          name: 'KitKat',
          calories: 518,
          fat: 26.0,
          carbs: 65,
          protein: 7,
        },
      ]*/
    },

    editItem (item) {

      console.log('toto')
      console.log(item)
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
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    closeDelete () {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    save () {
      console.log('saveee')
      if (this.editedIndex > -1) {
        console.log('nope')

        Object.assign(this.orderProductsItems[this.editedIndex], this.editedItem)
      } else {
        console.log(this.addProducts)
        console.log('push')

        this.submit()

        this.orderProductsItems.push(this.editedItem)
      }
      this.close()
    },

    submit() {
      let routeaction = this.submitAction
      let data = { order_id: this.order.id ,products: this.addProducts }
      this.$axios.post(route(routeaction), data)
        .then(response => {

          console.log(response)
          if (response.data.success) {

            // window.location = redirectionUrl
          } else {
            /*let errors = []
            response.data.response.forEach(function(responseMessage) {
              responseMessage.message.forEach(function(error) {
                errors.push({'message' : error})
              })
            })
            this.errorMessages = errors
            this.alertMessage = true*/
          }
        })
        .catch(error => {
          this.errorMessages = error.response.data.errors
          this.alertMessage = true
        })
    }
  },
}
</script>

<style scoped>

</style>
