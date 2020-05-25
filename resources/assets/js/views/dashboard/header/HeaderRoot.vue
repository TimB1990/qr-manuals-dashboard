<template>
  <div>
    <header-decoration></header-decoration>
    <div>
      <header-navigation></header-navigation>
    </div>
  </div>
</template>

<script>
import HeaderDecoration from "./components/HeaderDecoration";
import HeaderNavigation from "./components/HeaderNavigation";

export default {
  name: "headerRoot",
  components: { HeaderDecoration, HeaderNavigation }
};
</script>