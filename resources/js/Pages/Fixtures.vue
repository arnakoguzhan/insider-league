<template>

    <Head>
        <title>Fixtures</title>
        <meta type="description" content="Home information" head-key="description">
    </Head>

    <div>
        <h1 class="font-bold text-lg mb-4">
            Fixtures
        </h1>

        <WeekFixture :fixtures="fixtures" :simulationUid="simulationUid" />

        <div class="mt-6">
            <Button :href="`/${simulationUid}/standings`" color="blue" key="blue">
                Check standings
            </Button>
        </div>
    </div>
</template>

<script setup>
import Button from "../Shared/Button";
import WeekFixture from "../Shared/WeekFixture";

let props = defineProps({
    fixtures: Object,
    simulationUid: String,
});
</script>
