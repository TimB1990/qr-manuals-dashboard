<template>
  <div>
    <div class="tile is-ancestor is-vertical">
      <div class="tile is-parent">
        <div class="tile is-child">
          <code>header-view</code>
          <header-root></header-root>
        </div>
      </div>

      <div class="tile">
        <div class="tile is-parent is-4">
          <div class="tile is-child">
            <code>side-view</code>
            <side-root></side-root>
          </div>
        </div>

        <div class="tile is-parent">
          <div class="tile is-child">
            <code>main-view</code>
            <router-view></router-view>
          </div>
        </div>
      </div>

      <div class="tile">
        <div class="tile is-parent">
          <div class="tile is-child">
            <code>footer-view</code>
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
  name: "root",
  components: {
    HeaderRoot,
    SideRoot
  }
};
</script>  