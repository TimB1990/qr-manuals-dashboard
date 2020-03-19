<template>
<div class="container">
    <table>
        <tr>
            <td class="menu-info">
                <p><strong>RUITENWISSER 255BS 24V</strong></p>
                <p>Art nr. 212455.35</p>
            </td>
        </tr>
        <tr>
            <td class="menu-category">Documentation</td>
        </tr>
        <tr>
            <td class="menu-item">
                User manual (pdf)
                <i class="fa fa-chevron-right"></i>
            </td>
        </tr>
        <tr>
            <td class="menu-item">Technical documentation (pdf)
                <i class="fa fa-chevron-right"></i>
            </td>
        </tr>
        <tr>
            <td class="menu-category">Product</td>
        </tr>
        <tr>
            <td class="menu-item">Request a quote
                <i class="fa fa-chevron-right"></i>
            </td>
        </tr>
        <tr>
            <td class="menu-item">Order product online
                <i class="fa fa-chevron-right"></i>
            </td>
        </tr>
    </table>
</div>
</template>

<script>
export default {
    name: "viewpanel",
}
</script>

<style>
table{
    border: 1px solid hsl(0,0%,96%);
    width:100%;
}

.menu-category{
    background-color: #CC0033;
    color: white;
    padding: 16px;
}

.menu-item{
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    background-color: white;
    padding: 12px;
    border: 1px solid hsl(0,0%,96%);
}

.menu-item > i{
    font-size: 10px;
}

.menu-info{
    padding-left: 12px;
    padding-bottom: 12px;
    padding-top: 12px;
    background-color: white;
}
</style>