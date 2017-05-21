<template>
    <div id="group" class="container">
        <div class="card-field">
            <h1>{{group.name}}</h1>
            <p>{{group.description}}</p>
            <h2>Users</h2>
            <paginate
                    name="users"
                    :list="userItems"
                    :per="5"
            >
                <div class="standard-card" v-for="user in paginated('users')">
                    <div class="card-wrapper">
                        <!--<img :src="user.pictureUri">-->
                        <p>{{user.firstname}} {{user.lastname}}</p>
                    </div>
                </div>

            </paginate>
            <paginate-links for="users" :limit="5"></paginate-links>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                userItems:[],
                paginate: ['users'],
//                users : [],
                group: [],
            }
        },
        methods: {
            loadData: function (id) {
                this.axios.get('/api/groups/' + id).then((response) => {
                    console.log(response.data);
                    this.userItems = response.data.users;
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