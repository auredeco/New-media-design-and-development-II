<template>
    <header>
        <figure>
            <p id="hamburger">
                <i class="fa fa-bars fa-2x" aria-hidden="true"></i>
            </p>
        </figure>
        <h1>{{this.$route.name | capitalize}}</h1>
    </header>
</template>
<script>
    export default{

        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            }
        },
    }
</script>