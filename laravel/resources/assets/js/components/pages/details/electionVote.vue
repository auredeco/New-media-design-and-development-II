<template>
    <div id="election-vote" class="container">
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
            }
        },

        methods: {
            loadData: function (id) {
                this.axios.get('/api/elections/' + id).then((response) => {
                    this.election = response.data;
                });
            },
            vote(e) {
                if (confirm("Weet je zeker dat je op deze candidaat wilt stemmen?")) {
                    var password = prompt('Geef een wachtwoord op om later je stem te valideren');
                    console.log(e);
                    // get the event and take the id from the element that is clicked
                    // Store it in the candidateElection_id variable
                    let candidateElection_id = e.srcElement.id;
                    let _self = this;

                    this.axios.post('api/votes/',{
                        checksum: password,
                        voteType: 0,
                        agreed: null,
                        referendum_id: null,
                        CandidateElection_id: candidateElection_id
                    }).then(function (response) {
                        var vote = response.data;
                        alert('Houd deze code bij om in de toekomst uw stem te controleren: \n' + vote.uuid)
                        //redirect to the home page
                        _self.$router.push('/')
                    }).catch(function (error) {
                    });
                }
            }
        },
        mounted() {
            this.loadData(this.$route.params.id);
        }
    }
</script>