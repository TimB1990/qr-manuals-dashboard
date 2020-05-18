<template>
  <div id="root">
    <header class="header">
      <header-root></header-root>
    </header>
    <section class="side-and-main">
      <!--<side-root class="side"></side-root>-->
      <router-view name="side" class="side"></router-view>
      <router-view name="content" class="main"></router-view>
    </section>
  </div>
</template>

<script>
import HeaderRoot from "./header/HeaderRoot";

export default {
  // some comment
  name: "dashboard",
  components: {
    HeaderRoot
  }
};
</script>
<style>
/*.side-and-main {
  
  display: flex;
  margin-bottom: 18px;
  margin-top: 18px;
  align-items: stretch;
}*/

.main{
  width: 100%;
  margin-left: 18px;
}

.side{
  width: auto;
}

.header{
  margin-top: 16px;
}
</style>