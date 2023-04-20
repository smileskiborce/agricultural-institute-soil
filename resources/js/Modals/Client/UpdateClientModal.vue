<template>
    <base-modal
        id="updateClientModal"
        title="Изменете комитент"
        @submit="submit"
        @onshow="onShow"
        @instance="(_) => (modal = _)"
    >
        <template #default>
            <base-input
                v-model:value="form.name"
                class="mb-3"
                :name="form.name + '_update_name'"
                label="Име и презиме"
                :invalid="form.errors.name"
            />
            <base-input
                v-model:value="form.address"
                class="mb-3"
                :name="form.address + '_update_address'"
                label="Адреса"
                :invalid="form.errors.address"
            />
            <base-input
                v-model:value="form.phone"
                class="mb-3"
                :name="form.phone + '_update_phone'"
                label="Телефон"
                :invalid="form.errors.phone"
            />
            <base-input
                v-model:value="form.fax"
                class="mb-3"
                :name="form.fax + '_update_fax'"
                label="Фиксен"
                :invalid="form.errors.fax"
            />
            <base-input
                v-model:value="form.email"
                class="mb-3"
                :name="form.email + '_update_email'"
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
    name: "UpdateClientModal",
};
</script>
<script setup>
import { inject, ref } from "vue";
import BaseModal from "../Base/BaseModal.vue";
import BaseInput from "../../Components/BaseComponents/BaseInput.vue";
import BaseSelect from "../../Components/BaseComponents/BaseSelect.vue";
import { FIRM,INSTITUTION} from "../../constants";
import {useForm} from "@inertiajs/inertia-vue3";

const route = inject("route");
const client = ref(null);
const modal = ref(null);

const onShow = (event) => {
    client.value = JSON.parse(
        event.relatedTarget.getAttribute("data-bs-client")
    );
    form.name = client.value.name;
    form.address = client.value.address;
    form.phone = client.value.phone;
    form.fax = client.value.fax;
    form.email = client.value.email;
};

const form = useForm({
    name: "",
    address: "",
    phone: "",
    fax: "",
    email: "",
});

const submit = () => {
    form.put(route("clients.update", client.value), {
        onSuccess: () => {
            modal.value.hide();
            form.reset();
        },
    });
};
</script>

<style scoped></style>
