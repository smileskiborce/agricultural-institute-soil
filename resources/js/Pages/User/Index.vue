<template>
    <head-title title="Корисници | Земјоделски институт" />
    <table-view
        title="Корисници"
        button-text="Додади корисник"
        :table-headers="tableHeaders"
        target-store-modal="#storeUserModal"
        :can-see-create-button="can.users.create"
        :links="users.links"
        search-bar-placeholder="Пребарајте корисник..."
        route-name="users.index"
        :date-filters="false"
    >
        <tr v-for="(user, i) in users.data" :key="user.id">
            <td>
                {{ i + 1 }}
            </td>
            <td>
                {{ user.name }}
            </td>
            <td>
                {{ user.username }}
            </td>
            <td>
                {{ user.email }}
            </td>
            <td>
                {{ user.roles.map((a) => a.name).join(", ") }}
            </td>
            <td v-if="user.last_login">
                {{ moment(user.last_login).format("llll") }}
            </td>
            <td v-else>Корисникот сеуште не се најавил</td>
            <td>
                <div class="d-flex flex-nowrap">
                    <button
                        v-if="can.users.update"
                        data-bs-toggle="modal"
                        data-bs-target="#updateUserModal"
                        :data-bs-user="JSON.stringify(user)"
                        class="btn btn-sm btn-success me-1 text-nowrap"
                    >
                        <i class="fa fa-pencil"></i> Измени
                    </button>
                    <button
                        v-if="can.users.delete"
                        class="btn btn-sm btn-primary ms-1 text-nowrap"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal"
                        data-bs-title="Избришете корисник"
                        :data-bs-route="route('users.destroy', user.id)"
                    >
                        <i class="fa fa-trash"></i> Избриши
                    </button>
                </div>
            </td>
        </tr>
    </table-view>
    <store-user-modal :roles="roles" />
    <update-user-modal :roles="roles" />
</template>

<script>
import AdminDefaultLayout from "../../Layouts/AdminDefaultLayout.vue";

export default {
    name: "Index",
    layout: AdminDefaultLayout,
};
</script>
<script setup>
import { inject } from "vue";
import { useBase } from "../../Mixins/useBase";
import HeadTitle from "../../Components/HeadTitle.vue";
import StoreUserModal from "../../Modals/User/StoreUserModal.vue";
import UpdateUserModal from "../../Modals/User/UpdateUserModal.vue";
import TableView from "../../Components/BaseComponents/BaseCrudTableView.vue";

const { can } = useBase();
const moment = inject("moment");
const route = inject("route");
defineProps({
    users: {
        type: Object,
        default: null,
    },
    roles: {
        type: Array,
        default: null,
    },
});

const tableHeaders = [
    "#",
    "Име",
    "Корисничко име",
    "Е-пошта",
    "Улоги",
    "Последно најавен",
];
</script>

<style scoped></style>
