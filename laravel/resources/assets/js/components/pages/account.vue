<template>
    <div id="account" class="container">
        <div class="group">
            <figure>
                <img :src="user.picture">
            </figure>
            <div class="info">
                <h1>Mijn Profiel</h1>
                <table>
                    <tbody>
                    <tr>
                        <th>naam: </th>
                        <td>{{user.name}}</td>
                    </tr>
                    <tr>
                        <th>email: </th>
                        <td>{{user.email}}</td>
                    </tr>
                    <tr>
                        <th>geslacht: </th>
                        <td>{{user.gender}}</td>
                    </tr>
                    <tr>
                        <th>geboortedatum: </th>
                        <td>{{user.birthdate}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="groups">
            <h2>groepen</h2>
            <div class="card-field">
                <div class="standard-card" v-for="group in groups">
                    <div class="card-wrapper">
                        <router-link :to="{ name: 'group', params: { id: group.id }}">
                            <figure>
                                <img :src="group.pictureUri" alt="group image">
                            </figure>
                            <p>{{group.name}}</p>
                        </router-link>
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
                groups: [],
                user : [],
            }
        },
        methods: {
            loadData: function (id) {

                this.axios.get('/api/users/' + id).then((response) => {
                    let user = response.data;
                    this.groups = user.groups;
                    this.user = {
                        username: user.username,
                        name: user.firstname + " " + user.lastname,
                        gender: user.gender,
                        birthdate: user.birthdate,
                        email: user.email,
                        picture: user.pictureUri,
                    };
                    console.log(this.groups);
                    console.log(this.user);
                    console.log(response.data);
                });
            },
            loadUserData: function () {
                this.axios.get('api/user').then((response) => {
                    this.loadData(response.data.id);
                });
            }

        },
        mounted() {
            this.loadUserData()
        },


    }
</script>
