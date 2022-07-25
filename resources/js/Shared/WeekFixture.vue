<template>
    <div class="bg-white border border-gray-200 rounded-lg p-5">
        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
            Week 1
        </h3>
        <dl class="grid grid-cols-5 gap-4">
            <div class="col-span-2">
                <TeamName :team="teams[0]" />
            </div>

            <span class="text-center">-</span>

            <div class="col-span-2">
                <TeamName :team="teams[1]" />
            </div>
        </dl>
        <hr class="my-3">
        <dl class="grid grid-cols-5 gap-4">
            <div class="col-span-2">
                <TeamName :team="teams[2]" />
            </div>

            <span class="text-center">-</span>

            <div class="col-span-2">
                <TeamName :team="teams[3]" />
            </div>
        </dl>
    </div>
</template>

<script>
import TeamName from "../Shared/TeamName";

export default {
    props: {
        teams: {
            required: true,
            type: Object,
            default: [
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
            ]
        }
    },
    components: {
        TeamName
    }
};
</script>