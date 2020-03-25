<template>
  <div id="root">
    <div class="tile is-ancestor is-vertical">
      <div class="tile is-parent">
        <div class="tile is-child">
          <header-root></header-root>
        </div>
      </div>

      <div class="tile">
        <div class="tile is-parent is-4">
          <div class="tile is-child">
            <side-root></side-root>
          </div>
        </div>

        <div class="tile is-parent">
          <div class="tile is-child">
            <router-view></router-view>
          </div>
        </div>
      </div>

      <div class="tile">
        <div class="tile is-parent">
          <div class="tile is-child">
            <code>footer</code>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import HeaderRoot from "./header/HeaderRoot";
import SideRoot from "./side/SideRoot";

export default {
  name: "dashboard",
  components: {
    HeaderRoot,
    SideRoot
  }
};
</script>