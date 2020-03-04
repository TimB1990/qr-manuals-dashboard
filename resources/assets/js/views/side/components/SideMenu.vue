<template>
  <div>
    <aside class="panel is-primary">
      <div class="panel-block">
        <p class="control has-icons-left">
          <input class="input" type="text" placeholder="Search Products..." />
          <span class="icon is-left">
            <i class="fa fa-search" aria-hidden="true"></i>
          </span>
        </p>
      </div>

      <p class="panel-block">Products</p>

        <side-menu-item :product_name="'product A'"/>
        <side-menu-item :product_name="'product B'"/>

      <!-- other component -->
    </aside>
  </div>
</template>

<script>
import SideMenuItem from './SideMenuItem'
export default {
  name: "sideMenu",
  components: { SideMenuItem }
};
</script>