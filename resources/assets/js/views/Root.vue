<template>
  <div>
     <router-view></router-view>
  </div>
</template>

<script>

import Entry from './entry/Entry';
import Dashboard from './dashboard/Dashboard';
import ProductPage from './productpage/ProductPage';

export default {
  name: "root",
  components: {Entry, Dashboard, ProductPage}
};
</script>