<template>
  <nav class="paginator">
    <a v-if="pagination.current_page > 1" @click.prevent="changePage(pagination.current_page - 1)" class="button">&laquo;</a>
    <a v-for="(page,i) in pagesNumber" :class="{'button' : true, 'active' : pagination.current_page == page}" :key="i" @click.prevent="changePage(page)">{{ page }}</a>
    <a v-if="pagination.current_page < pagination.last_page" class="button" @click.prevent="changePage(pagination.current_page + 1)">&raquo;</a>
  </nav>
</template>

<script>
export default {
  name: "sideMenuPaginator",
  props: {
    pagination: {
      type: Object,
      required: true
    },
    offset: {
      type: Number,
      default: 3
    }
  },

  computed: {
    pagesNumber() {
      if (!this.pagination.to) {
        return [];
      }
      let from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      let to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      let pagesArray = [];
      for (let page = from; page <= to; page++) {
        pagesArray.push(page);
      }
      return pagesArray;
    }
  },

  methods: {
    changePage(page) {
      this.pagination.current_page = page;
      this.$emit("paginate", page);
    },
  }
};
</script>   

<style scoped>
.paginator {
  display: block;
  padding: 14px;
}
.paginator a.active {
  background-color: #cc0033;
  color: white;
}

.paginator a:hover:not(.active) {
  background-color: hsl(0, 0%, 96%);
}
</style>