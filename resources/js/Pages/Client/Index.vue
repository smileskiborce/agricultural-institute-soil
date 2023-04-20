<template>
    <head-title title="Комитенти | Земјоделски институт" />
    <table-view
        title="Комитенти"
        button-text="Додади комитент"
        :table-headers="tableHeaders"
        target-store-modal="#storeClientModal"
        :can-see-create-button="true"
        :links="clients.links"
        search-bar-placeholder="Пребарајте комитент..."
        route-name="clients.index"
        :date-filters="false"
    >
        <tr v-for="(client, i) in clients.data" :key="client.id">
            <td>
                {{ i + 1 }}
            </td>
            <td>
                {{ client.name }}
            </td>
            <td>
                {{ client.email }}
            </td>
            <td>
                {{ client.address }}
            </td>
            <td>
                <a class="text-dark" :href="'tel:' + client.phone">
                    {{ client.phone }}
                </a>
            </td>
            <td>
                <a
                    v-if="client.fax"
                    class="text-dark"
                    :href="'tel:' + client.fax"
                >
                    {{ client.fax }}
                </a>
            </td>
            <td>
                <div class="d-flex flex-nowrap">
                    <button
                        v-if="true"
                        data-bs-toggle="modal"
                        data-bs-target="#updateClientModal"
                        :data-bs-client="JSON.stringify(client)"
                        class="btn btn-sm btn-success me-1 text-nowrap"
                    >
                        <i class="fa fa-pencil"></i> Измени
                    </button>
                    <button
                        v-if="true"
                        class="btn btn-sm btn-primary ms-1 text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-bs-title="Избришете комитент"
                        :data-bs-route="route('clients.destroy', client.id)"
                    >
                        <i class="fa fa-trash"></i> Избриши
                    </button>
                </div>
            </td>
        </tr>
    </table-view>
    <store-client-modal />
    <update-client-modal />
</template>

<script>
import AdminDefaultLayout from "../../Layouts/AdminDefaultLayout.vue";

export default {
    name: "Index",
    layout: AdminDefaultLayout,
};
</script>
<script setup>
import HeadTitle from "../../Components/HeadTitle.vue";
import TableView from "../../Components/BaseComponents/BaseCrudTableView.vue";
import StoreClientModal from "../../Modals/Client/StoreClientModal.vue";
import UpdateClientModal from "../../Modals/Client/UpdateClientModal.vue";
import {FIRM,INSTITUTION} from "../../constants";

defineProps({
    clients: {
        type: Object,
        default: null,
    },
});

const tableHeaders = [
    "#",
    "Име",
    "Е-пошта",
    "Адреса",
    "Телефон",
    "Факс",
];
</script>

<style scoped></style>
