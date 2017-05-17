<template>
    <div>
        <paginate-links for="items"></paginate-links>
            <paginate
                    name="referenda"
                    :list="items"
                    :per="5"
            >
                <div v-for="item in paginated('referenda')">
                    <p>{{item.title}}</p>
                    <p>{{item.description}}</p>
                    <p>Status:
                        <span v-if="item.isClosed">Closed</span>
                        <span v-else >Open</span>
                    </p>
                    <p>
                        <router-link :to="{ name: 'referendum', params: { id: item.id }}">lees meer</router-link>
                    </p>
                </div>

            </paginate>
        <paginate-links for="referenda" :limit="5"></paginate-links>
    </div>
</template>


<script>
    export default {

        data() {
            return {
                items: [],
                paginate: ['referenda']
            }
        },

        methods: {
            loadData: function () {
                this.axios.get('/api/referenda').then((response) => {
                    this.items = response.data.sort(function(a,b) {
                        return new Date(a.endDate).getTime() - new Date(b.endDate).getTime()
                    });
                });
            },
        },

        mounted() {
            this.loadData();
            console.log('Referenda mounted.');
        }
    }
</script>