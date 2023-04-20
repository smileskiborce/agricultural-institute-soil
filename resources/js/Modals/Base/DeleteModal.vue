<template>
    <base-modal
        id="deleteModal"
        :title="title"
        @submit="submit"
        @onshow="onShow"
        @instance="(_) => (modal = _)"
    >
        <template #default>
            <h3>
                Дали сте сигурни дека сакате да го избришете избраниот ентитет?
            </h3>
        </template>
        <template #footer>
            <button
                type="submit"
                class="btn btn-danger"
                :disabled="form.processing"
            >
                <i class="fa fa-trash"></i> Избриши
            </button>
        </template>
    </base-modal>
</template>

<script>
export default {
    name: "DeleteModal",
};
</script>
<script setup>
import { ref } from "vue";
import BaseModal from "./BaseModal.vue";
import { useForm } from "@inertiajs/vue3";

const modal = ref(null);

const form = useForm({});

const title = ref("Null");
const route = ref(null);

const onShow = (event) => {
    title.value = event.relatedTarget.getAttribute("data-bs-title");
    route.value = event.relatedTarget.getAttribute("data-bs-route");
};

const submit = () => {
    form.delete(route.value, {
        onSuccess: () => {
            modal.value.hide();
        },
    });
};
</script>
<style scoped></style>
