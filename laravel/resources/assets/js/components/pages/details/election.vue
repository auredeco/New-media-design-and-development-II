<template>
    <div>
        <img src="/images/logo-square.svg">
        <h1>{{election.name}}</h1>
        <p>{{election.description}}</p>
        <p v-if="election.isClosed">Gesloten</p>
        <p v-else>Lopend</p>
        <p>loopt af op: {{ election.endDate }}</p>
        <hr />
        <table>
            <thead>
                <th>Kandidaat</th>
                <th>Partij</th>
            </thead>
            <tbody>
            <tr v-for="candidate in election.candidates">
                <td>{{ candidate.user.firstname }} {{ candidate.user.lastname }}</td>
                <td>{{ candidate.party.name }}</td>
            </tr>
            </tbody>
        </table>
        <div class="button-field" v-if="!election.isClosed">
            <router-link :to="{ name: 'electionVote', params: { id: election.id }}">
                                <button class="btn blue">Stemmen</button>
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                election: [],
            }
        },

        methods: {
            loadData: function (id) {
                this.axios.get('/api/elections/' + id).then((response) => {
                    this.election = response.data;
                    console.log(this.election)
                });
            },
        },
        mounted() {
            this.loadData(this.$route.params.id);
            console.log('Election mounted.')
            console.log(this.$route.params.id)
        }
    }
</script>