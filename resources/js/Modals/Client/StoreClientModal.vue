<template>
    <base-modal
        id="storeClientModal"
        title="Додадете комитент"
        @submit="submit"
        @instance="(_) => (modal = _)"
    >
        <template #default>
            <base-input
                v-model:value="form.name"
                class="mb-3"
                name="name_client"
                label="Барател"
                :invalid="form.errors.name"
            />
            <base-input
                v-model:value="form.address"
                class="mb-3"
                name="address_client"
                label="Адреса"
                :invalid="form.errors.address"
            />
            <base-input
                v-model:value="form.phone"
                class="mb-3"
                name="phone_client"
                label="Телефон"
                :invalid="form.errors.phone"
            />
            <base-input
                v-model:value="form.fax"
                class="mb-3"
                name="fax_client"
                label="Фиксен"
                :invalid="form.errors.fax"
            />
            <base-input
                v-model:value="form.email"
                class="mb-3"
                name="email_client"
                label="Е-пошта"
                :invalid="form.errors.email"
            />
        </template>
        <template #footer>
            <button
                :disabled="form.processing"
                type="submit"
                class="btn btn-success"
            >
                <i class="fa fa-save"></i> Зачувај
            </button>
        </template>
    </base-modal>
</template>

<script>
export default {
    name: "StoreClientModal",
};
</script>
<script setup>
import {useForm} from "@inertiajs/inertia-vue3";
import BaseModal from "../Base/BaseModal.vue";
import BaseInput from "../../Components/BaseComponents/BaseInput.vue";
import {ref} from "vue";


const modal= ref(null)



const form = useForm({
    name: "",
    address: "",
    phone: "",
    fax: "",
    email: "",
});

const submit = () => {
    form.post(route("clients.store"),{
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
    })
};
</script>

<style scoped></style>
