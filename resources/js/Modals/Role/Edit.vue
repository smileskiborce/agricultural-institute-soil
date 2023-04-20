<template>
    <head-title title="Измени улога" />
    <form @submit.prevent="submit">
        <h5>
            <strong> Измени улога </strong>
        </h5>
        <base-input
            v-model:value="form.name"
            class="my-4 col-12 col-md-6 col-lg-4"
            name="name"
            label="Име"
            :disabled="true"
            :invalid="form.errors.name"
        />
        <label class="form-label">Пермисии</label>
        <div v-if="form.errors.permissions" class="text-danger">
            {{ form.errors.permissions }}
        </div>
        <div class="mb-3 row">
            <div
                v-for="permission in permissions"
                :key="permission.id"
                class="col-12 col-sm-6 col-md-4 col-xl-3"
            >
                <input
                    :id="permission.id"
                    v-model="form.permissions"
                    type="checkbox"
                    :value="permission.id"
                    :name="permission.id"
                />
                <label :for="permission.id">{{ permission.name }}</label>
                <br />
            </div>
        </div>
        <div class="text-end">
            <Link
                :href="route('roles.index')"
                class="btn btn-secondary me-2 text-nowrap"
            >
                Затвори
            </Link>
            <button
                :disabled="form.processing"
                type="submit"
                class="btn btn-success"
            >
                <i class="fa fa-save"></i> Зачувај
            </button>
        </div>
    </form>
</template>

<script>
import AdminDefaultLayout from "../../Layouts/AdminDefaultLayout.vue";

export default {
    name: "Edit",
    layout: AdminDefaultLayout,
};
</script>

<script setup>
import { inject } from "vue";
import { useForm } from "@inertiajs/vue3";
import HeadTitle from "../../Components/HeadTitle.vue";
import BaseInput from "../../Components/BaseComponents/BaseInput.vue";

const route = inject("route");

const props = defineProps({
    permissions: {
        type: Array,
        required: true,
    },
    role: {
        type: Object,
        required: true,
    },
    rolePermissions: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: props.role.name,
    permissions: props.rolePermissions.map(function (obj) {
        return obj.id;
    }),
});

const submit = () => {
    form.put(route("roles.update", props.role), {
        onSuccess: () => {},
    });
};
</script>

<style scoped></style>
