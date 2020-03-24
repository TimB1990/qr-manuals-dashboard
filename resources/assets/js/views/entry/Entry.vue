<template>
  <div>
    <div class="dialog">
      <div class="header-dialog">
        <img src="/img/EXALTO-TG-logo-WEB.png" />
      </div>
      <div>
        <div class="field-container">
          <i class="fas fa-at icon"></i>
          <input type="text" name="email" id="email" placeholder="email" />
        </div>
        <div class="field-container">
          <i class="fas fa-key icon"></i>
          <input type="password" name="password" id="pass" placeholder="password" />
        </div>
        <div>
          <button class="submit-button">submit</button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: "entry"
};
</script>

<style>
.dialog {
  margin-top: 16px;
  padding: 12px;
  width: 400px;
  border: 1px solid black;
}

.field-container {
  display: flex;
  margin-bottom: 12px;
  border-radius: 6px;
  align-items: baseline;
  padding: 8px;
  border: 1px solid black;
}

.field-container > input {
  width: 100%;
  padding: 3px;
  border: 1px solid black;
}

.submit-button {
  margin: 3px 3px 3px 3px;
  background-color: transparent;
  border: 1px solid hsl(0, 0%, 76%);
  padding: 8px 12px 8px 12px;
  /*border-radius: 6px;*/
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  outline: none;
}

.submit-button:hover{
     border: 1px solid hsl(0, 0%, 76%);
  background-color: hsl(0, 0%, 86%);
}

.icon {
  padding-top: 12px;
  padding-bottom: 12px;
  padding-left: 16px;
  padding-right: 16px;
}

.header-dialog > img {
  height: 80px;
  width: auto;
}
</style>