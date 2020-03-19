<template>
<div class="container base">
    <img id="logo" src="/img/EXALTO-TG-logo-WEB.png" />
    <div>
        <!--<scanner></scanner>-->
        <view-panel></view-panel>
    </div>
    <div>
        <button>Scan a different product</button>
    </div>
</div>
</template>

<script>
import Scanner from './components/Scanner';
import ViewPanel from './components/ViewPanel';

export default {
    name: "productpage",
    components: {Scanner, ViewPanel}
}
</script>

<style>
.base{
    background-color: hsl(0,0%,96%);
    padding: 24px;
}
</style>