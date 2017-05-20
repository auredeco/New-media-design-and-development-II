<template>
    <div class="container">
        <h1>Welkom {{user.username}}</h1>
        <h2>Persoonlijke info</h2>
        <img :src="user.picture">
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
        <h2>groepen</h2>
        <div class="card-field">
            <div class="standard-card" v-for="group in groups">
                <div class="card-wrapper">


                    <router-link :to="{ name: 'group', params: { id: group.id }}">
                        <p>{{group.name}}</p>
                    </router-link>

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
                    this.groups = response.data.groups;
                    let user = response.data.user
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
