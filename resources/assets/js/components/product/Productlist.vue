<template>
  <div class="container">
    <article class="panel is-primary">
      <p class="panel-heading level">
        Product-list
        <button v-if="this.loading" class="button is-primary is-loading"></button>
      </p>
      <div class="panel-block">
        <p class="control has-icons-left">
          <input class="input is-primary" type="text" placeholder="Search" />
          <span class="icon is-left">
            <i class="fa fa-search" aria-hidden="true"></i>
          </span>
        </p>
      </div>
      <a class="panel-block" 
        v-for="product in productslist" 
        :key="product.id"
        @click="loadDetails(product.id)"
      >
        <span class="is-active">
          <ul>
            <li>
              <b v-text="product.name"></b>
            </li>
            <li>{{ product.artnr }} | {{ product.kind }}</li>
          </ul>
          <nav class="breadcrumb is-small">
            <ul>
              <li v-for="(category,index) in product.categories" :key="index">
                <a href="#">{{ category.name }}</a>
              </li>
            </ul>
          </nav>
        </span>
      </a>
    </article>
  </div>
</template>

<script>
export default {
  name: "productlist",
  data() {
    return {
      productslist: null,
      loading: true
    };
  },

  methods:{
    loadDetails(id){
      // do emit from root, to send id over along with event loadDetails
      this.$root.$emit('loadDetails', id);
    }

  },

  mounted() {
    axios
      .get("/products")
      .then(response => {
        this.productslist = response.data;
        this.loading = false;
        console.log(this.productslist);
      })
      .catch(error => console.log(error));
  }
};
</script>
