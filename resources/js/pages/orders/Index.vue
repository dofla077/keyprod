<template>
  <v-app id="inspire">
    <div>
      <v-card>
        <v-card-title>
          {{ title }}
          <v-spacer />
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          />
        </v-card-title>
        <v-data-table
          :headers="headers"
          :items="items"
          :search="search"
          @click:row="rowClick"
        >
          <template v-if="!retailurl" #item.state="props">
            <v-edit-dialog
              :return-value.sync="props.item.state"
              @save="save(props.item)"
              @cancel="cancel"
              @close="close"
            >
              {{ props.item.state }}
              <template #input>
                <v-text-field
                  v-model="props.item.state"
                  :rules="[max25chars]"
                  label="Edit"
                  single-line
                  counter
                />
              </template>
            </v-edit-dialog>
          </template>
          <template v-if="!retailurl" #item.tracking="props">
            <v-edit-dialog
              :return-value.sync="props.item.tracking"
              large
              persistent
              @save="save(props.item)"
              @cancel="cancel"
              @close="close"
            >
              <div>{{ props.item.tracking }}</div>
              <template #input>
                <div class="mt-4 text-h6">
                  Update tracking
                </div>
                <v-text-field
                  v-model="props.item.tracking"
                  :rules="[max25chars]"
                  label="Edit"
                  single-line
                  counter
                  autofocus
                />
              </template>
            </v-edit-dialog>
          </template>
        </v-data-table>
        <v-snackbar
          v-if="!retailurl"
          v-model="snack"
          :timeout="3000"
          :color="snackColor"
        >
          {{ snackText }}

          <template v-if="!retailurl" #action="{ attrs }">
            <v-btn
              v-bind="attrs"
              text
              @click="snack = false"
            >
              Close
            </v-btn>
          </template>
        </v-snackbar>
      </v-card>
    </div>
  </v-app>
</template>

<script>
import indexMixin from '../../mixins/indexMixin'
import editDialogMixin from '../../mixins/editDialogMixin'

export default {
  name: 'IndexDefault',
  mixins: [indexMixin, editDialogMixin],
  props: {
  },
  data: () => ({

  }),
  methods: {
    rowClick: function (item) {
      if (this.retailurl) {
        window.location = route(this.retailurl, item.id)
      }
    }
  }
}

</script>

<style scoped>
</style>

