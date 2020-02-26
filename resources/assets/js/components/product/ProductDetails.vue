<template>
  <div class="container">
    <p class="content is-medium has-text-centered">product details:</p>
    <div>
      <table class="table is-fullwidth">
        <tr>
          <td>art nr</td>
          <td>content</td>
        </tr>
        <tr>
          <td>fuse</td>
          <td>content</td>
        </tr>
        <tr>
          <td>driven shafts</td>
          <td>content</td>
        </tr>
      </table>
    </div>
    <br />
    <div>
      <table class="table is-bordered">
        <tr>
          <td>artnr:</td>
          <td>content</td>
          <td id="qrcode-canvas" rowspan="2">
            <qrcode-vue :value="value" :size="size" level="H"></qrcode-vue>
          </td>
        </tr>
        <tr>
          <td>url:</td>
          <td>{{this.value}}</td>
        </tr>
      </table>
    </div>
    <br>
    <div>
        <table class="table is-bordered">
            <tr>
                <td>art nr:</td>
                <td>211240.30</td>
            </tr>
            <tr>
                <td>file name:</td>
                <td>Manual.pdf</td>
            </tr>
            <tr>
                <td>download url:</td>
                <td>{{this.value}}/download?file=manual</td>
            </tr>
        </table>
        
    </div>
  </div>
</template>

<script>
import QrcodeVue from "qrcode.vue";
export default {
  components: { QrcodeVue },
  data() {
    return {
      value: "https://example.com/products/12345",
      size: 100
    };
  }
};
</script>  
