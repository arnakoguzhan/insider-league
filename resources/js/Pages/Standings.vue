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
                class="rounded-l-md rounded-r-none hover:bg-gray-100" :href="`/${simulationUid}/play-all`" method="post"
                as="button">
                Play all
            </Button>

            <Button color="white" textColor="gray-700" key="nextWeek"
                class="border-r-0 border-l-0 rounded-r-none rounded-l-none hover:bg-gray-100"
                :href="`/${simulationUid}/play-week`" method="post" as="button">
                Next Week
            </Button>

            <Button color="red" key="reset" class="rounded-l-none rounded-r-md" :href="`/${simulationUid}/reset`"
                method="delete" as="button">
                Reset
            </Button>
        </span>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div class="col-span-1">
            <Standing :standings="standings" />
        </div>

        <div class="col-span-1">
            <WeekFixture :fixtures="nextFixture" :simulationUid="simulationUid"
                :title="`Next week (Week ${Object.keys(nextFixture)[0]})`" />

            <div v-show="nextFixture.length == 0" class="grid gap-y-6">
                <div class="bg-white border border-gray-200 rounded-lg p-5">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                        Simulation completed
                    </h3>
                </div>
            </div>

            <WeekFixture :fixtures="lastPlayedFixture" :simulationUid="simulationUid" title="Last week" class="mt-4" />

            <Button textColor="blue-600" class="justify-center" link key="seeFixture"
                :href="`/${simulationUid}/fixtures`">
                See all fixtures
            </Button>
        </div>
    </div>
</template>

<script setup>
import Button from "../Shared/Button";
import WeekFixture from "../Shared/WeekFixture";
import Standing from "../Shared/Standing";

let props = defineProps({
    standings: Object,
    nextFixture: Object,
    lastPlayedFixture: Object,
    simulationUid: String
});
</script>
