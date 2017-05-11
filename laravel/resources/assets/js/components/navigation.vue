<template>
    <nav id="mobile-nav" class="is-closed">
        <header>
            <img src="images/logo.svg">
            <i class="fa fa-times fa-2x" aria-hidden="true" id="cross"></i>
        </header>
        <ul>
            <li v-for="element in data.elements">
                <i :class="element.fontA" aria-hidden="true"></i>
                <a :href="element.link">
                    {{element.name}}
                </a>
            </li>
        </ul>
    </nav>
</template>
<script>
    let data = {
        elements: [
            {
                name: 'home',
                fontA: 'fa fa-home',
                link: '#'
            },
            {
                name: 'verkiezingen',
                fontA: 'fa fa-check',
                link: '#'
            },
            {
                name: 'Referenda',
                fontA: 'fa fa-comments',
                link: '#'
            },
            {
                name: 'Mijn Profiel',
                fontA: 'fa fa-user',
                link: '#'
            },
            {
                name: 'Instellingen',
                fontA: 'fa fa-cog',
                link: '#'
            },
            {
                name: 'Inloggen',
                fontA: 'fa fa-power-off',
                link: '#'
            },
        ],

    };
    export default{
        data() {
        return {
            data
        }
    }
    }
</script>