<template>
  <div class="container">

    <p><strong>manuals upload</strong></p>
    <main-product-manuals-upload :id="this.id"></main-product-manuals-upload>

  </div>
</template>

<script>
import MainProductManualsUpload from './MainProductManualsUpload';
export default {
  name: 'mainProductManualsManager',
  components:{
    MainProductManualsUpload
  },

  props: {
    id: Number
  },

  created(){
    //
  },

  methods:{
    //
  },

  computed:{

    //
  }

}
</script>