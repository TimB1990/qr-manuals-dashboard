<template>
  <div>
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
            <main-root></main-root>
          </div>
        </div>
      </div>

      <div class="tile">
        <div class="tile is-parent">
          <div class="tile is-child">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import HeaderRoot from "./header/HeaderRoot";
import SideRoot from "./side/SideRoot";
import MainRoot from "./main/MainRoot";

export default {
  name: "root",
  components: {
    HeaderRoot,
    SideRoot,
    MainRoot
  }
};
</script>  