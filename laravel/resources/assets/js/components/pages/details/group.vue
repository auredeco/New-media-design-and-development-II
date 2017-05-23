<template>
    <div id="group" class="container">
        <div class="card-field">
            <h1>{{group.name}}</h1>
            <p>{{group.description}}</p>
            <button v-if="!listed" @click="join">Lid worden</button>
            <h2>Users</h2>
            <paginate
                    name="users"
                    :list="userItems"
                    :per="5"
            >
                <div class="standard-card" v-for="user in paginated('users')">
                    <router-link :to="{ name: 'user', params: { id: user.id }}">
                        <div class="card-wrapper">
                            <!--<img :src="user.pictureUri">-->
                            <p>{{user.firstname}} {{user.lastname}}</p>
                        </div>
                    </router-link>
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
                user : [],
                group: [],
                listed: false,

            }
        },
        methods: {
            loadData: function (id) {
                this.axios.get('/api/groups/' + id).then((response) => {
                    console.log(response.data);
                    this.userItems = response.data.users;
                    this.group = response.data.group;
                    console.log(this.user);
                    console.log(this.group);
                    this.checkListed();
                });
            },
            loadUserData: function (groupId) {
                this.axios.get('/api/user').then((response) => {
                    this.user = response.data;
                    this.loadData(groupId);
                });
            },
            join: function() {
                this.axios.post('/api/groups/join',{
                    group_id: this.group.id,
                    user_id: this.user.id,

                }).then((response) => {
                    console.log(response.data);
                });

            },
            checkListed() {
                let filtered = _.filter(this.userItems, { 'id': this.user.id});
                (filtered.length === 0)?this.listed = false : this.listed = true;
                console.log(this.listed);


            }
        },
        mounted() {
            this.loadUserData(this.$route.params.id);
            console.log('Group mounted.')
        }
    }
</script>