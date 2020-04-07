<template>
  <div>
    <header-decoration></header-decoration>
    <div>
      <header-navigation></header-navigation>
      <header-actionbar></header-actionbar>
    </div>
  </div>
</template>

<script>
import HeaderDecoration from "./components/HeaderDecoration";
import HeaderNavigation from "./components/HeaderNavigation";
import HeaderActionbar from "./components/HeaderActionbar";

export default {
  name: "headerRoot",
  components: { HeaderDecoration, HeaderNavigation, HeaderActionbar }
};
</script>
<style>
.header-nav-actionbar {
  background-color: transparent;
  padding: 12px;
  box-shadow: 0 0.5em 1em -0.125em rgba(10, 10, 10, 0.1), 0 0px 0 1px rgba(10, 10, 10, 0.02);
  border-radius: 6px;
}
</style>