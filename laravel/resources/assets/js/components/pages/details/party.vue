<template>
    <div id="party" class="container">
        <div class="card-field">
            <h1>{{party.name}}</h1>
            <p>{{party.description}}</p>
            <h2>kandidaten</h2>
            <paginate
                    name="users"
                    :list="userItems"
                    :per="5"
            >
                <div class="standard-card" v-for="candidate in paginated('users')">
                    <div class="card-wrapper">
                        <router-link :to="{ name: 'user', params: { id: candidate.user.id }}">
                            <!--<img :src="candidate.user.pictureUri">-->
                            <p>{{candidate.user.firstname}} {{candidate.user.lastname}}</p>
                        </router-link>
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
                party: [],
            }
        },
        methods: {
            loadData: function (id) {
                this.axios.get('/api/parties/' + id).then((response) => {
                    console.log(response.data);
                    this.party = response.data;
                    this.userItems = this.party.candidates;

                });
            },
        },
        mounted() {
            this.loadData(this.$route.params.id);
            console.log('Party mounted.')
        }
    }
</script>