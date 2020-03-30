<template>
  <div class="root">
    <div class="dialog">
       <p><strong>Request A Quote</strong></p>
       <p>artnr: {{ this.$route.query.artnr}}</p>
       <p>name: {{ this.$route.query.name}}</p>
      <div>
        <div class="field-container">
          <i class></i>
          <input type="text" placeholder="Company name..." />
        </div>
        <div class="field-container">
          <i class></i>
          <input type="text" placeholder="Contact name..." />
        </div>
        <div class="field-container">
          <i class></i>
          <input type="text" placeholder="Contact name..." />
        </div>
        <div class="field-container">
          <i class="fas fa-at icon"></i>
          <input type="text" placeholder="Email..." />
        </div>
        <div class="field-container">
          Amount:
          <input type="number" />
        </div>
        <div class="dialog-footer">
          <!--<div></div>-->
          <button class="submit-button">Submit</button>
        </div>
      </div>
      </div>
    </div>
</template>

<script>
export default {
  name: "quoteform"
};
</script>

<style>
</style>

