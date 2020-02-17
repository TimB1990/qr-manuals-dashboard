<template>
  <div class="container">
    <div class="columns">
      <div class="column">
        <!-- upload elements -->
        <upload></upload>
        <p>recently uploaded:</p>
      </div>
    </div>
  </div>
</template>

<script>
import Upload from '../components/Upload'

export default {
    components: { Upload }
};
</script>  