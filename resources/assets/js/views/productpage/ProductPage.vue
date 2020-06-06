<template>
  <div>
    <img id="logo" src="/img/EXALTO-TG-logo-WEB.png" />
    <div class="page-content">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Scanner from "./components/Scanner";
import ViewPanel from "./components/ViewPanel";
import QuoteForm from "./components/QuoteForm";

export default {
  name: "productpage",
  components: { Scanner, ViewPanel, QuoteForm }
};
</script>