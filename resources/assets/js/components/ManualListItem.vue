<template>
  <div class="columns box is-vcentered">
      <div class="column is-three-quarters">
          <p><b>id:</b>12345</p>
          <p><b>uri:</b> {{ value }}</p>
          <p><b>product-name:</b> Product 12345</p>
          <p><b>description:</b> Some short description...</p>
      </div>
      <!-- temporary -->
      <div class="column is-narrow">
          <qrcode-vue :value="value" :size="size" level="H"></qrcode-vue>
      </div>
  </div>
</template>
<script>
  import QrcodeVue from 'qrcode.vue'
 
  export default {
    data() {
      return {
        value: 'https://example.com/manuals/product?id=12345',
        size: 150,
      }
    },
    components: {
      QrcodeVue,
    },
  }
</script> 