<template>

    <Head>
        <title>Standings</title>
        <meta type="description" content="Standings information" head-key="description">
    </Head>

    <div class="flex items-center justify-between mb-4">
        <h1 class="font-bold text-lg">
            Standings
        </h1>

        <span class="relative z-0 inline-flex shadow-sm rounded-md">
            <Button color="white" textColor="gray-700" key="playAll"
                class="rounded-l-md rounded-r-none hover:bg-gray-100">
                Play all
            </Button>

            <Button color="white" textColor="gray-700" key="nextWeek"
                class="border-r-0 border-l-0 rounded-r-none rounded-l-none hover:bg-gray-100">
                Next Week
            </Button>

            <Button color="red" key="reset" class="rounded-l-none rounded-r-md">
                Reset
            </Button>
        </span>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-1">
            <div class="shadow overflow-hidden border border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Team
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                P
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                W
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                D
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                L
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                GD
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Chance
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(team, teamIndex) in teams" :key="team.handle"
                            :class="teamIndex % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                            <td class="p-4 whitespace-nowrap">
                                <TeamName :team="team" />
                            </td>
                            <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                                1
                            </td>
                            <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                                2
                            </td>
                            <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                                3
                            </td>
                            <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                                3
                            </td>
                            <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                                3
                            </td>
                            <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                                %50
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-span-1">
            <WeekFixture />
        </div>
    </div>
</template>

<script setup>
import Button from "../Shared/Button";
import TeamName from "../Shared/TeamName";
import WeekFixture from "../Shared/WeekFixture";

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
</script>
