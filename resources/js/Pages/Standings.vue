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
            <Standing :standings="standings" />
        </div>

        <div class="col-span-1">
            <WeekFixture :fixtures="nextFixture" />
        </div>
    </div>
</template>

<script setup>
import Button from "../Shared/Button";
import WeekFixture from "../Shared/WeekFixture";
import Standing from "../Shared/Standing";

let props = defineProps({
    standings: Array,
    nextFixture: Array,
});
</script>
