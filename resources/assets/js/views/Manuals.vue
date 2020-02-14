<template>
  <div class="container">
    <div class="columns">
      <extended-search></extended-search>
    </div>
    <div class="columns">
      <div class="column">
        <div class="message">
          <div class="message-header">
            <p>Manual test product</p>
          </div>
          <div class="message-body">
            <p>Some test manual...</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import ExtendedSearch from '../components/ExtendedSearch'

export default {
  components: { ExtendedSearch }
};
</script>  