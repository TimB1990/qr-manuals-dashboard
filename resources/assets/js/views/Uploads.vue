<template>
  <div class="tile is-ancestor">
    <div class="tile is-parent">
      <productlist></productlist>
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
import Productlist from "../components/productlist/Productlist"

export default {
  components: { Upload, Productlist },
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