<template>
    <h1>Account</h1>
</template>

<script>
    export default {
        mounted() {
            console.log('Account mounted.');

            this.axios.get('api/user').then((response) => {
                console.log(response.data);
            })
        }
    }
</script>