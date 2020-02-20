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
      <a
        class="panel-block is-active"
        v-for="(item, index) in items"
        :key="index"
      >{{item.productid}} | {{item.productname}} | {{item.description}}</a>
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
          productid: 12345,
          productname: "wiper model-260",
          description: "some description"
        },
        {
          productid: 23456,
          productname: "wiper model-270",
          description: "some description"
        },
        {
          productid: 345678,
          productname: "wiper model-280",
          description: "some description"
        }
      ]
    };
  },

  methods: {}
};
</script>
