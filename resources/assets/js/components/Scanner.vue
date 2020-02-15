<template>
<!-- shoud contain class is-active -->
<div class="modal is-active">
  <div class="modal-background"></div>
  <div class="modal-content">
    <!-- Any other Bulma elements you want -->
  </div>
  <button class="modal-close is-large" aria-label="close" @click="close">cancel</button>
</div>
</template>

<script>
export default {
  name: 'scanner',
  methods: {

    close(){

      this.$emit('close');

    }

  }
};
</script>