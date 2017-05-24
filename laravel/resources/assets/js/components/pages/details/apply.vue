<template>
    <div class="container">
        <h2>Kandidatuur</h2>
        <form @submit.prevent="register">
            <div class="form-group">
                <label for="party">party:</label>
                <select id="party" name="party" v-model="party" required >
                    <option v-for="party in parties" :value="party.id">{{party.name}}</option>
                </select>
            </div>
            <input type="submit" value="submit" >
        </form>
        <div>
            <!--<p v-for="message in messages">-->
                <!--&lt;!&ndash;{{message}}&ndash;&gt;-->
            <!--</p>-->
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                election: [],
                party: null,
                parties: [],
                user : [],
            }
        },
        methods: {
            loadData: function (id) {
                this.axios.get('/api/elections/' + id).then((response) => {
                    this.election = response.data;
                    this.checkReg();
                });
                this.axios.get('/api/parties/').then((response) => {
                    this.parties = response.data;
                });
            },
            loadUserData: function (electionId) {
                this.axios.get('api/user').then((response) => {
                    this.user = response.data;
                    this.loadData(electionId);
                });
            },
            register: function() {
                console.log(this.election.id);
                console.log(this.party);
                console.log(this.user.id);
                this.axios.post('api/candidates/',{
                    election_id: this.election.id,
                    user_id: this.user.id,
                    party_id:  this.party,

                }).then((response) => {
                    console.log(response.data);
                    this.$router.push({ name: 'election', params: { id: this.$route.params.id }});
                });
            },
            checkReg(){
                let candidates = this.election.candidates;

                self = this;
                for (let i = 0; i < candidates.length; i++) {

                    if(self.user.id === candidates[i].user_id || new Date() > new Date(self.election.startDate)){
                            console.log("nope");
                            self.$router.push({ name: 'election', params: { id: self.$route.params.id }});                    }

                }
            },
        },
        mounted() {
            this.loadUserData(this.$route.params.id);
        },


    }
</script>
