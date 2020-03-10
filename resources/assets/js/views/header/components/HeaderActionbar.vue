<template>
<nav class="actionbar">

    <span>actionbar</span>

    <div class="actionbar-end">
        <span class="actionbar-item">QR</span>
        <span class="actionbar-item">QR</span>
    </div>
</nav>

</template>

<script>
export default {
  name: "headerActionbar",
  components: {}
};
</script>

<style>
.actionbar{
    overflow: hidden;
    padding:12px;
    border: 1px solid black;
}
.actionbar-end{
    float:right;
    display:flex;
    align-items: center;
}

.actionbar-item{
    border: 1px solid grey;
    padding:3px;
    margin-left:6px;
    border-radius: 6px;
}


</style>
