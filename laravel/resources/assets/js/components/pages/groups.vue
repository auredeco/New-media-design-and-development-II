<template>
    <div id="groups" class="container">
        <h1>Groepen</h1>
        <paginate-links for="items"></paginate-links>
        <paginate
                name="groups"
                :list="items"
                :per="6"
        >
            <div class="card-field">
                <div class="standard-card" v-for="item in paginated('groups')">
                    <router-link :to="{ name: 'group', params: { id: item.id }}">
                        <div class="card-wrapper">
                            <div class="card">
                                <figure>
                                    <img :src="item.pictureUri">
                                </figure>
                                <h1>{{item.name}}</h1>
                            </div>
                        </div>
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