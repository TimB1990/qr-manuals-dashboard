<template>
    <div>
        <header-decoration></header-decoration>
        <header-navigation></header-navigation>
        <header-actionbar></header-actionbar>
    </div>
</template>

<script>
import HeaderDecoration from './components/HeaderDecoration'
import HeaderNavigation from './components/HeaderNavigation'
import HeaderActionbar from './components/HeaderActionbar'

export default {
    name: 'headerRoot',
    components:{ HeaderDecoration, HeaderNavigation, HeaderActionbar }
}
</script>