<template>
  <div class="container">
    <extended-search></extended-search>
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
import ExtendedSearch from "../components/ExtendedSearch";

export default {
  name: "manuals",
  components: { ExtendedSearch }
};
</script>  