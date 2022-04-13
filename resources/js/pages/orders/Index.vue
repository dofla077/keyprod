<template>
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
      :loading="true"
      :headers="headers"
      :items="items"
      :search="search"
      @click:row="rowClick"
    >
      <template v-if="!items.length" #no-data>
        NO DATA HERE!
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
import indexMixin from '../../mixins/indexMixin'

export default {
  name: 'IndexDefault',
  mixins: [indexMixin],
  props: {
  },
  data: () => ({
  }),
  mounted() {

  },
  methods: {
    rowClick: function (item, row) {
      console.log(item.id)
      console.log(item)
      console.log(row)
      // row.select(true)

      window.location = route(this.retailurl, item.id)
      //item.name - selected id
    },
  }
}

</script>

<style scoped>
</style>

