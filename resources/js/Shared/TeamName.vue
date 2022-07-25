<template>
    <div class="flex items-center space-x-4">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0">
                <img class="h-8 w-8 rounded-full" :src="team.imageUrl" :alt="team.name" />
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900">
                    {{ team.name }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        team: {
            required: true,
            type: Object,
            default: {}
        }
    }
};
</script>