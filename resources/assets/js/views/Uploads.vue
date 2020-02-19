<template>
  <div class="tile is-ancestor">
    <div class="tile is-parent">
      <article class="tile is-child box">
        <p class="title">Product List</p>
        <!--<p class="subtitle">12345</p>-->
        <div class="content">
          <div class="notification box" v-for="(item, index) in items" :key="index">
            {{item.productid}} | {{item.productname}} | {{item.description}}
          </div>
        </div>
      </article>
    </div>
    <div class="tile is-parent is-6">
      <article class="tile is-child box">
        <upload></upload>
      </article>
    </div>
  </div>
</template>

<script>
import Upload from "../components/Upload";

export default {
  components: { Upload },
  data(){

    return{
      items:[
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
    }

  }
};
</script>  