<template>
  <div class="container">
    <div id="searchbar">
      <extended-search></extended-search>
    </div>
    <div id="list-item-divs">
      <manual-list-item style="margin-top: 30px"></manual-list-item>
    </div>
  </div>
</template>

<script>
import ExtendedSearch from "../components/ExtendedSearch";
import ManualListItem from "../components/ManualListItem";

export default {
  name: "manuals",
  components: { ExtendedSearch, ManualListItem }
};
</script>  