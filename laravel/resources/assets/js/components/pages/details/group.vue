<template>
    <div id="group" class="container">
        <h1>{{group.name}}</h1>
        <p>{{group.description}}</p>
        <h2>Users</h2>
        <ul>
            <li v-for="user in users">{{user.firstname}}</li>
        </ul>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                users : [],
                group: [],
            }
        },
        methods: {
            loadData: function (id) {
                this.axios.get('/api/groups/' + id).then((response) => {
                    console.log(response.data);
                    this.users = response.data.users;
                    this.group = response.data.group;
                });
            },
        },
        mounted() {
            this.loadData(this.$route.params.id);
            console.log('Group mounted.')
        }
    }
</script>