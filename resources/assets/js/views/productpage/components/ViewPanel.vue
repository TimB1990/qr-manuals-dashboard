<template>
  <div class="menu-root">
    <table>
      <tr>
        <td class="menu-header">
          <p id="product">
            {{ product[0].name}}
            <i id="stock" class="fa fa-check-circle"></i>
          </p>
          <p>Art nr. {{ product[0].artnr }}</p>
        </td>
      </tr>
      <tr>
        <td class="menu-category">
          <i class="fa fa-book"></i>
          Documentation
        </td>
      </tr>
      <tr>
        <td class="menu-item">
          User manual (pdf)
          <i class="fa fa-chevron-right"></i>
        </td>
      </tr>
      <tr>
        <td class="menu-item">
          Technical documentation (pdf)
          <i class="fa fa-chevron-right"></i>
        </td>
      </tr>
      <tr>
        <td class="menu-category">
          <i class="fa fa-dropbox"></i>
          Product
        </td>
      </tr>
      <tr>
        <td class="menu-item">
          Request a quote
          <i class="fa fa-chevron-right"></i>
        </td>
      </tr>
      <tr>
        <td class="menu-item">
          Order product online
          <i class="fa fa-chevron-right"></i>
        </td>
      </tr>
      <tr>
        <td class="menu-footer"></td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  name: "viewpanel",
  props:{
    product: Array
  }
};
</script>

<style>
table {
  width: 100%;
}

.menu-category {
  background-color: #cc0033;
  word-spacing: 3px;
  color: white;
  padding: 12px;
  box-shadow: 0 6px 8px 0 hsl(0,0%,70%), 0 12px 20px 0 hsl(0,0%,80%);
}

.menu-item {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  background-color: white;
  padding: 14px;
  border: 1px solid hsl(0, 0%, 96%);
  box-shadow: 0 6px 1px 0 hsl(0,0%,70%), 0 12px 20px 0 hsl(0,0%,80%);
}

.menu-item:hover{
  background-color: hsl(0,0%,94%);
  border: 1px solid hsl(0,0%,85%);
}

.menu-item > i {
  font-size: 10px;
}

.menu-header {
  border-radius: 16px 16px 0px 0px;
  padding-left: 16px;
  padding-bottom: 18px;
  padding-top: 18px;
  background-color: white;
  box-shadow: 0 6px 8px 0 hsl(0,0%,70%), 0 12px 20px 0 hsl(0,0%,80%);
}

.menu-footer {
  padding: 28px;
  background-color: white;
  border-radius: 0px 0px 16px 16px;
  /*box-shadow: 12px 10px 16px rgba(0, 0, 0, 0.3);*/
  box-shadow: 0 6px 8px 0 hsl(0,0%,70%), 0 12px 20px 0 hsl(0,0%,80%);
}

#stock {
  font-size: 21px;
  color: #29a329;
  padding-left: 6px;
  padding-right: 6px;
}

#product{
  font-weight: bold;
  font-size: 18px;
  color: black;
}
</style>