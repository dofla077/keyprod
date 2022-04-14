<template>
  <v-app id="inspire">
    <div>
      <v-data-table
        v-model="shipment"
        :headers="headers"
        :items="enrichedOrderProductsItem"
        sort-by="id"
        class="elevation-1"
        item-key="name"
        show-select
        hide-default-header
      >
        <template #top>
          <v-toolbar
            flat
          >
            <v-toolbar-title v-if="submitAction === 'orders.products.add'">
              Order number : {{ order.number }}
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
                      <v-col cols="12" lg="8">
                        <v-text-field
                          v-model="addItem.weight"
                          label="weight"
                          required
                        />

                        <v-select
                          v-model="addItem.product"
                          :items="products" label="Select product"
                          persistent-hint
                        >
                          <template #selection="{ item, index }">
                            <qr-code text="Text to encode" :size="50" :margin="10" /> {{ item.label }}
                          </template>
                          <template #item="{ item }">
                            <qr-code text="Text to encode" :size="50" :margin="10" /> {{ item.label }}
                          </template>
                        </v-select>

                        <v-radio-group v-model="addItem.state" row>
                          <v-radio
                            label="To prepare"
                            value="1"
                          />
                          <v-radio
                            label="Prepared"
                            value="2"
                          />
                        </v-radio-group>
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

        <template #header="{ props, on }">
          <thead>
            <tr>
              <th v-for="header in props.headers" :key="header.value">
                <v-simple-checkbox
                  v-if="header.value === 'data-table-select'"
                  v-model="props.everyItem"
                  :indeterminate="props.someItems && !props.everyItem"
                  color="purple"
                  @input="on['toggle-select-all']"
                />
                <span v-else>
                  {{ header.text }}
                </span>
              </th>
            </tr>
          </thead>
        </template>

        <template #item.state="{ item }">
          <v-chip :color="getColor(item.state)" dark>
            {{ item.state }}
          </v-chip>
        </template>
      </v-data-table>
      <div class="text-center pt-2">
        <v-btn v-if="shipment.length" color="primary" @click="setShipment">
          Add shipment
        </v-btn>
      </div>
    </div>
  </v-app>
</template>

<script>
import relatedProductMixin from '../../mixins/relatedProductMixin'
export default {
  name: 'RelatedProducts',
  mixins: [relatedProductMixin],
}
</script>

<style scoped>

</style>
