<template>
    <div id="groups" class="container">
        <paginate-links for="items"></paginate-links>
        <paginate
                name="groups"
                :list="items"
                :per="5"
        >
            <div class="standard-card" v-for="item in paginated('groups')">
                <div class="card-wrapper">
                    <router-link :to="{ name: 'group', params: { id: item.id }}">
                        <img src="/images/logo-square.svg">
                        <h1>{{item.name}}</h1>
                    </router-link>
                </div>
            </div>
        </paginate>
        <paginate-links for="groups" :limit="5"></paginate-links>
    </div>
</template>


<script>
    export default {

        data() {
            return {
                items: [],
                paginate: ['groups']
            }
        },

        methods: {
            loadData: function () {
                this.axios.get('/api/groups').then((response) => {
                    this.items = response.data;
                    console.log(this.items)
                });
            },
        },

        mounted() {
            this.loadData();
            console.log('Referenda mounted.');
        }
    }
</script>