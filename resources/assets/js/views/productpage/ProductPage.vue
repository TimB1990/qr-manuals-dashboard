<template>
  <div class="base">
    <div class="page-header">
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
  padding: 18px;
  height: 731px;
  background-color: hsl(0,0%,96%);
}

.page-header {
  margin-top: 18px;
  margin-bottom: 24px;
}

.page-footer {
  display: flex;
  justify-content: space-evenly;
}

.page-footer > button {
  color: hsl(0, 0%, 40%);
  background-color: transparent;
  border-radius: 6px;
  font-size: 18px;
  padding-top: 10px;
  padding-bottom: 10px;
  padding-left: 24px;
  padding-right: 24px;
  cursor: pointer;
  border: 1px solid hsl(0, 0%, 40%);
  display: inline;
}
</style>