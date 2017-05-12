<template>
    <nav id="mobile-nav" class="is-closed">
        <header>
            <img src="images/logo.svg">
            <i class="fa fa-times fa-2x" aria-hidden="true" id="cross"></i>
        </header>
        <ul>
            <li>
                <i class="fa fa-home" aria-hidden="true"></i>
                <router-link @click.native="hideNav" :to="{ path: '/'}">Home</router-link>

            </li>
            <li>
                <i class="fa fa-check" aria-hidden="true"></i>
                <router-link @click.native="hideNav" :to="{ path: 'elections'}">elections</router-link>
            </li>
            <li>
                <i class="fa fa-comments" aria-hidden="true"></i>
                    <router-link @click.native="hideNav" :to="{ path: 'referenda'}">referenda</router-link>
            </li>
            <li>
                <i class="fa fa-user" aria-hidden="true"></i>
                    <router-link @click.native="hideNav" :to="{ path: 'groups'}">groups</router-link>
            </li>
            <li>
                <i class="fa fa-cog" aria-hidden="true"></i>
                    <router-link @click.native="hideNav" :to="{ path: 'parties'}">parties</router-link>
            </li>
            <li>
                <i class="fa fa-power-off" aria-hidden="true"></i>
                    <router-link @click.native="hideNav" :to="{ path: 'account'}">account</router-link>
            </li>
        </ul>
    </nav>
</template>
<script>
    export default{
        data(){
            return{
                mobileNav: '',
            }
        },
        methods: {
            hideNav(){
                document.getElementById('mobile-nav').className= "is-closed";
            }
    }
    }
</script>