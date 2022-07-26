<template>
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
                <tr v-for="(standing, standingIndex) in standings" :key="standingIndex"
                    :class="standingIndex % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                    <td class="p-4 whitespace-nowrap">
                        <TeamName :team="standing.team" />
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                        {{ standing.points }}
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                        {{ standing.won }}
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                        {{ standing.draw }}
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                        {{ standing.lost }}
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                        {{ standing.goal_difference }}
                    </td>
                    <td class="p-4 whitespace-nowrap text-sm text-gray-500">
                        <span v-show="standing.winChance == -1">NA</span>
                        <span v-show="standing.winChance != -1">%{{ standing.winChance }}</span>
                    </td>
                </tr>
            </tbody>
            <tfoot class="bg-gray-200">
                <tr>
                    <th colspan="7" class="px-4 py-3 text-left text-xs font-medium text-gray-500">
                        The estimations will be available after the 4th week, and will be updated each week.
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
import TeamName from "../Shared/TeamName";

export default {
    props: {
        standings: {
            required: true,
            type: Array,
        }
    },
    components: {
        TeamName
    }
};
</script>