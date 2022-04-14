export default {
  props: {
    title: {
      type: String,
      default: 'Index'
    },
    items: {
      type: Array,
      default: null
    },
    headers: {
      type: Array,
      default: null
    },
    retailurl: {
      type: String,
      default: null
    }
  },
  data: () => ({
    search: '',

  }),
  methods: {
  }
}
