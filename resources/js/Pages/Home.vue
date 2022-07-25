<template>

    <Head>
        <title>Home</title>
        <meta type="description" content="Home information" head-key="description">
    </Head>

    <div>
        <h1 class="font-bold text-lg mb-4">
            Teams
        </h1>

        <div class="flow-root mt-6 bg-gray-100 rounded-lg py-6 px-2">
            <ul role="list" class="-my-5 divide-y divide-gray-200">
                <li v-for="team in teams" :key="team.handle" class="py-4">
                    <TeamName :team="team" />
                </li>
            </ul>
        </div>
        <div class="mt-6">
            <form @submit.prevent="submit">
                <Button color="blue" key="blue" type="submit" :isLoading="form.processing">
                    Generate fixtures
                </Button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import Button from "../Shared/Button";
import TeamName from "../Shared/TeamName";

const teams = [
    {
        name: 'Liverpool',
        handle: 'liverpool',
        imageUrl: 'https://resources.premierleague.com/premierleague/badges/25/t14.png',
    },
    {
        name: 'Manchester City',
        handle: 'manchester-city',
        imageUrl: 'https://resources.premierleague.com/premierleague/badges/25/t43.png',
    },
    {
        name: 'Chelsea',
        handle: 'chelsea',
        imageUrl: 'https://resources.premierleague.com/premierleague/badges/25/t8.png',
    },
    {
        name: 'Arsenal',
        handle: 'arsenal',
        imageUrl: 'https://resources.premierleague.com/premierleague/badges/25/t3.png',
    },
];

let form = useForm();
let submit = () => {
    form.post('/generate-fixtures');
};

let props = defineProps({
    teams: Array,
});
</script>
