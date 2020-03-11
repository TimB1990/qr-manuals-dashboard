<template>
  <div class="side-menu-item" ref="item">
    <ul @click="fetchDetails(product_id)">
      <li>{{ product_name }}</li>
      <li>{{ product_artnr }} : {{ product_kind }}</li>
    </ul>
    <nav v-if="categories">
      <span>
        <i @click="addRemoveSelected(product_id)" :class="itemClassObject"></i>
      </span>
      <span v-for="(category,i) of categories" :key="i">
        <a href="#">{{ category.name }}</a> |
      </span>
    </nav>
  </div>
</template>

<script>
export default {
  name: "sideMenuItem",
  props: {
    product_id: Number,
    product_artnr: String,
    product_name: String,
    product_kind: String,
    categories: Array
  },

  methods: {
    fetchDetails(id) {
      console.log("navigate to details of:", id);
      this.$router
        .replace({
          name: "product_details",
          params: {
            id: id
          }
        })
        .catch(err => {});
    },

    addRemoveSelected(id) {
      // first check if id is included in productIsSelected getters from store
      if (this.$store.getters.productIsSelected(id)) {
        this.$store.dispatch("removeSelectedProduct", {id : id});
      } else {
        this.$store.dispatch("addSelectedProduct", {id : id});
      }
    }
  },

  computed: {
    itemClassObject() {
      let selected = this.$store.getters.productIsSelected(this.product_id);
      return {
        fa: true,
        "fa-check": true,
        selected: selected
      };
    }
  }
};
</script>

<style scoped>
.side-menu-item {
  display: flex;
  flex-direction: column;
  border: 1px solid hsl(0, 0%, 86%);
  padding: 8px;
  margin-bottom: 14px;
  margin-left: 14px;
  margin-right: 14px;
  border-radius: 4px;
}

.side-menu-item:hover {
  /*border: 1px solid hsl(0, 0%, 25%);*/
  border: 1px solid hsl(0, 0%, 50%);
  background-color: hsl(0, 0%, 99%);
}

nav > span > a {
  color: hsl(0, 0%, 50%);
}

span > i {
  padding: 1px;
  border: 1px solid hsl(0, 0%, 86%);
  color: hsl(0, 0%, 86%);
  font-size: 18px;
  float: right;
}

span > i:hover {
  border: 1px solid hsl(0, 0%, 50%);
  color: hsl(0, 0%, 50%);
}

.selected {
  border: 1px solid hsl(0, 0%, 50%);
  color: hsl(0, 0%, 50%);
}

nav > span {
  font-size: 12px;
}
</style>