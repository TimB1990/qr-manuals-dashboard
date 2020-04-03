<template>
  <div class="base">
    <div>
      <img id="logo" src="/img/EXALTO-TG-logo-WEB.png" />
    </div>

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

<style>
.base {
  background-color: hsl(0,0%,96%);
}

.page-content {
  height: 731px;
  padding: 16px;
}

#logo{
 margin-left: 16px;
 margin-top: 16px;

}
</style>