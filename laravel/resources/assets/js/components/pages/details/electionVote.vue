<template>
    <div id="election-vote" class="container">
        <div v-if="loading"  class="loader"></div>
        <div class="candidate" v-for="candidate in election.candidates" v-if="candidate.pivot.approved">
            <div class="candidate-wrapper">
                <figure class="user-image">
                    <img v-bind:src="candidate.user.pictureUri" />
                </figure>
                <div class="candidate-info">
                    <h1>{{ candidate.user.firstname }} {{ candidate.user.lastname }}</h1>
                    <p>{{ candidate.party.name }}</p>
                    <div class="button-field">
                        <button class="btn green" v-bind:id="candidate.pivot.id" @click="vote">Stemmen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                election: [],
                user: [],
                loading: true,
            }
        },

        methods: {
            loadData: function (id, userId) {

                this.axios.get('/api/users/' + userId).then((response) => {
                    this.user = response.data;
                    this.axios.get('/api/elections/' + id).then((response) => {
                        this.election = response.data;
                        if(this.election.candidates.length == 0){
                            this.$router.push({ name: 'elections'});
                        }else {
                            this.checkVoted();
                        }
                    });
                });
            },
            loadUserData: function (electionId) {
                this.axios.get('api/user').then((response) => {
                    this.loadData(electionId, response.data.id);
                });
            },
            vote(e) {
//                console.log(this.election.id);
//                console.log(this.user.id);
                if (confirm("Weet je zeker dat je op deze candidaat wilt stemmen?")) {
                    var password = prompt('Geef een wachtwoord op om later je stem te valideren');
                    console.log(e);
                    // get the event and take the id from the element that is clicked
                    // Store it in the candidateElection_id variable
                    let candidateElection_id = e.srcElement.id;
                    console.log(candidateElection_id);
                    let _self = this;

                    this.axios.post('api/votes/',{
                        checksum: password,
                        voteType: 0,
                        user_id: this.user.id,
                        election_id: this.election.id,
                        agreed: null,
                        referendum_id: null,
                        CandidateElection_id: candidateElection_id
                    }).then(function (response) {
                        console.log(response.data);
                        var vote = response.data;
                        alert('Houd deze code bij om in de toekomst uw stem te controleren: \n' + vote.uuid)
                        console.log('redirect');
                        window.location.reload();
//

                    }).catch(function (error) {
                    });
                }
            },
            checkVoted(){
                let self = this;
                let history = self.user.history;
                for(let i = 0; i < history.length;  i++){
                    let electionId = self.user.history[i];
                    console.log(electionId.election_id);
                    if(electionId.election_id == self.election.id){
                        self.voted = true;
                        console.log('true mdfkr');
                        console.log(self.voted);
                        this.$router.push({ name: 'elections'});
                        break;
                    }
                }
                this.stopLoading();
            },
            redirect() {
                console.log('redirecting fuck');

//                window.location.reload();
//                this.$router.push({ name: 'election', params: { id: this.election.id }});

            },
            stopLoading: function () {
                let self = this;
                setTimeout(function(){ self.loading = false; }, 1500);
            }
        },
        mounted() {
            this.loadUserData(this.$route.params.id);
        }
    }
</script>