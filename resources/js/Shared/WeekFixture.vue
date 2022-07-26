<template>
    <div class="grid gap-y-6">
        <div v-for="(week, weekId) in fixtures" class="bg-white border border-gray-200 rounded-lg p-5">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                <span v-show="title">{{ title }}</span>
                <span v-show="!title">Week {{ weekId }}</span>
            </h3>

            <div class="grid divide-y">
                <dl v-for="fixture in week" class="grid grid-cols-5 py-2 first:pt-0 last:pb-0">
                    <div class="col-span-2">
                        <TeamName :team="fixture.host" />
                    </div>

                    <span v-show="!fixture.playedAt">-</span>
                    <span v-show="fixture.playedAt">
                        {{ fixture.hostGoals }} - {{ fixture.guestGoals }}
                    </span>

                    <div class="col-span-2">
                        <TeamName :team="fixture.guest" />
                    </div>
                </dl>
            </div>
        </div>
    </div>
</template>

<script>
import TeamName from "../Shared/TeamName";

export default {
    props: {
        title: {
            type: String,
        },
        fixtures: {
            required: true,
            type: Array,
        }
    },
    components: {
        TeamName
    }
};
</script>