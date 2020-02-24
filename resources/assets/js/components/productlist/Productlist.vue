<template>
  <div>
    <article class="panel is-primary">
      <p class="panel-heading">Product-list</p>
      <div class="panel-block">
        <p class="control has-icons-left">
          <input class="input is-primary" type="text" placeholder="Search" />
          <span class="icon is-left">
            <i class="fa fa-search" aria-hidden="true"></i>
          </span>
        </p>
      </div>
      <a class="panel-block" v-for="(item, index) in items" :key="index">
        <span class="is-active">
          <ul>
            <li>
              <b v-text="item.name"></b>
            </li>
            <li>{{ item.nr }} | {{ item.kind }}</li>
            <li>
                
              <nav class="breadcrumb is-small" aria-label="breadcrumbs">
                <ul>
                  <li v-for="(cat,i) in item.categories" :key="i">
                      <a>{{ item.categories[i] }}</a>
                  </li>
                </ul>
              </nav>
            </li>
          </ul>
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
      items: [
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
      ]
    };
  },

  methods: {
    
  }
};
</script>
