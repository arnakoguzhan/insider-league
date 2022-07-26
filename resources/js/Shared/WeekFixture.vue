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
                    <span v-show="fixture.playedAt" class="flex items-center">
                        {{ fixture.hostGoals }} - {{ fixture.guestGoals }}
                        <svg @click="showEditModal(fixture.id, fixture.hostGoals, fixture.guestGoals)"
                            xmlns="http://www.w3.org/2000/svg" class="ml-2 text-blue-600 h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd"
                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>

                    <div class="col-span-2">
                        <TeamName :team="fixture.guest" />
                    </div>
                </dl>
            </div>

            <Modal :showing="showModal" @close="closeEditModal" :showClose="true" :backgroundClose="true">
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label class="block text-sm font-medium text-gray-900">
                            <span class="text-gray-700">Host Goals</span>
                            <input v-model="form.editingHostGoals" type="number" min="0"
                                class="border p-3 w-full border-gray-300 rounded-md shadow-sm text-gray-900 sm:text-sm focus:ring-gray-500 focus:border-gray-500 mt-1">
                            <div v-if="form.errors.editingHostGoals">{{ form.errors.editingHostGoals }}</div>
                        </label>
                    </div>

                    <div class="sm:col-span-6">
                        <label class="block text-sm font-medium text-gray-900">
                            <span class="text-gray-700">Guest Goals</span>
                            <input v-model="form.editingGuestGoals" type="number" min="0"
                                class="border p-3 w-full border-gray-300 rounded-md shadow-sm text-gray-900 sm:text-sm focus:ring-gray-500 focus:border-gray-500 mt-1">
                            <div v-if="form.errors.editingGuestGoals">{{ form.errors.editingGuestGoals }}</div>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end mt-5">
                    <Button color="blue" key="submitFixture" @click="submitFixture" :isLoading="form.processing">
                        Save
                    </Button>
                </div>
            </Modal>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'
import TeamName from "../Shared/TeamName";
import Modal from "../Shared/Modal";
import Button from './Button.vue';

export default {
    data() {
        return {
            form: useForm({
                fixtureId: null,
                editingHostGoals: null,
                editingGuestGoals: null,
            }),
            showModal: false,
        }
    },
    methods: {
        showEditModal: function (fixtureId, hostGoals, guestGoals) {
            this.showModal = true;
            this.form.fixtureId = fixtureId;
            this.form.editingHostGoals = hostGoals;
            this.form.editingGuestGoals = guestGoals;
        },

        closeEditModal: function () {
            this.showModal = false;
            this.form.reset()
        },

        submitFixture: function () {
            console.log('submitFixture');
            // Update the fixture
            this.form.put(`/${this.simulationUid}/fixtures/${this.form.fixtureId}`, {
                preserveScroll: true,
            })
            this.closeEditModal();
        },
    },
    props: {
        title: {
            type: String,
        },
        fixtures: {
            type: Object,
            required: true,
        },
        simulationUid: {
            type: String,
            required: true,
        },
    },
    components: {
        TeamName,
        Modal,
        Button
    }
};
</script>