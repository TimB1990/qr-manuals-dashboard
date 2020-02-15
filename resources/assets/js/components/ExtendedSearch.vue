<template>
  <div class="columns">
    <div class="column">
      <form>
        <div class="field is-grouped">
          <p class="control has-icons-left is-expanded">
            <input class="input" type="text" placeholder="Find a Manual" />
            <span class="icon is-medium is-left">
              <i class="fa fa-search" aria-hidden="true"></i>
            </span>
          </p>
          <p class="control">
            <a class="button is-info">Search</a>
            <button class="button is-info" @click="toggleScanner">Scan QR Code</button>
          </p>
        </div>
      </form>
    </div>
    <scanner v-if="openScanner" @close="toggleScanner"></scanner>
  </div>
</template>

<script>
import Scanner from "../components/Scanner.vue";

export default {
  name: "extendedSearch",
  components: { Scanner },
  data(){
    return {
      openScanner : false
    }
  },
  methods: {
    toggleScanner(){
      this.openScanner = !this.openScanner;
    }
  }
};
</script>  