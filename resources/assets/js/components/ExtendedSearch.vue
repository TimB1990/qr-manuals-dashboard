<template>
  <div class="columns">
    <div class="column">
      <form>
        <div class="field is-grouped">
          <p class="control has-icons-left is-expanded">
            <input class="input" type="text" placeholder="Enter product code" />
            <span class="icon is-medium is-left">
              <i class="fa fa-search" aria-hidden="true"></i>
            </span>
          </p>
          <p class="control">
            <button class="button is-info">Search</button>
            <button class="button is-info">Extended Search</button>
            <button class="button is-info" @click="toggleScanner">Scan QR Code</button>
          </p>
        </div>
      </form>
    </div>
    <!-- only show if openScanner = true, on close event sended from Scanner call toggleScanner -->
    <scanner v-if="openScanner" @close="toggleScanner"></scanner>
  </div>
</template>

<script>
import Scanner from "../components/Scanner.vue";

export default {
  name: "extendedSearch",
  components: { Scanner },
  data() {
    return {
      openScanner: false
    };
  },
  methods: {
    toggleScanner() {
      this.openScanner = !this.openScanner;
    }
  }
};
</script>  