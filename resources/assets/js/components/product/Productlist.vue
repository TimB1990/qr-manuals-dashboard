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
      <a class="panel-block" v-for="(product, index) in productslist" :key="index">
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
      /*items: [
        {
          nr: "211240.30",
          name: "EXALTO RW 240BS 12V ..° 40NM WD 30 MM",
          kind: "240 BS",
          categories: ["Ruitenwissers", "motorunits"]
        },
        {
          nr: "211255.35",
          name: "EXALTO RUITENWISSER 255BS 12V ..° 55NM WD 35 MM",
          kind: "255 BS",
          categories: ["Ruitenwissers", "motorunits"]
        },
        {
          nr: "212430.25",
          name: "EXALTO RUITENWISSER XP2 24V 30NM WD25",
          kind: "MD1 - 230XP",
          categories: ["Ruitenwissers", "motorunits"]
        }
      ]*/
    };
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
