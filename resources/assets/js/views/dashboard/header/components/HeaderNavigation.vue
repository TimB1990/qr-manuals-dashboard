<template>
  <section>
    <nav class="navigationbar" role="navigation" aria-label="main navigation">
      <!-- navbar menu -->
      <div class="navigation-left">
        <span>
          <a href="./">Home</a>
        </span>
      </div>

      <div class="navigation-right">
        <span>
          <a href="./scan" target="_blank">customer product page</a>
        </span>
        <span>
          <a>
            profile
            <i class="fa fa-user" />
            
          </a>
        </span>
        <span>
          <a>
            
            sign out
            <i class="fa fa-sign-out-alt"/> 
          </a>
        </span>
      </div>
    </nav>
  </section>
</template>



<script>
export default {
  name: "headerNavigation",
  components: {}
};
</script>

<style scoped>
.navigationbar {
  border: 1px solid hsl(0, 0%, 60);
  padding-left: 16px;
  height:40px;
  padding-right: 16px;
  display: flex;
  justify-content: space-between;
  background-color: rgb(204, 0, 51);
  color: white;
  border: 1px solid hsl(0, 0%, 60);
}

nav > div > span > a {
  color: rgb(255, 255, 255);
  cursor: pointer;
  display: inline;
  font-family: "Roboto Condensed", sans-serif, sans-serif;
  font-size: 16.8px;
  line-height: 40px;
  list-style-image: none;
  list-style-position: outside;
  list-style-type: none;
  overflow-wrap: break-word;
  text-align: left;
  text-size-adjust: 100%;
  text-transform: uppercase;
}

nav > div > span {
  display: inline-block;
  padding: 0px 6px 0px 6px;
}

nav > div > span:hover {
  border: 1px solid hsl(0, 0%, 60%);
  border-bottom-color: white;
  background-color: white;
}

nav > div > span:hover > a {
  color: rgb(204, 0, 51);
}

.navigation-right > span {
  margin-right: 12px;
}
</style>



